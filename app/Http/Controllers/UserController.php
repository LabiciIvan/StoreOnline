<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;
use App\Models\User;
use App\Http\Requests\StoreOrders;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProfile;
use App\Services\Cart;
class UserController extends Controller
{
    public function __construct() {

        $this->middleware('auth')->only('profile', 'history');
    }

    public function index() {

        return view('user.index', ['products' => Products::all()]);
    }

    public function show($id) {

        return view('user.show', ['product' => Products::with('reviews')->findOrFail($id), 'reviews' => Products::withCount('reviews')->findOrFail($id)]);
    }

    public function addCartIndex($id) {

        $product = Products::findOrFail($id);
        $notAdded = true;
        $quantity = 1;

        if ($product->stock == 0) {

            Session::flash('outStock', 'Item out of Stock');

            return redirect()->route('user.index');
        }

        $toSession = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'quantity' => $quantity,
            'totalPrice' => $quantity * $product->price

        ];

        if(Session::has('product')) {
            foreach(Session::get('product') as $key => $value) {
                if($value['id'] == $id) {
                    ++$value['quantity'];
                    $value['totalPrice'] = $value['quantity'] * $value['price'];
                    $notAdded = false;
                    Session::put('product.'.$key, $value);
                    Session::flash('status', 'Item increased in your cart!');
                }
            }
        }
        if($notAdded) {
            Session::push('product',  $toSession);
            Session::flash('status', 'Item added to cart');
        }

        return redirect()->route('user.index');
    }

    public function addCartShow($id) {

        $product = Products::findOrFail($id);

        $cart = resolve(Cart::class);
        $cart->checkItemStock($product);
        $cart->itemAvailableAddToCart($product, $id);

        return redirect()->route('user.show', $product->id);
    }


    public function viewCart() {

        $element = Session::get('product');
        $cart = resolve(Cart::class);

        return view('user.cart',['element' => $element, 'total' =>$cart->totalCart($element)]);
    }

    public function checkOut() {

        // $cart = new Cart();
        $cart = resolve(Cart::class);

        $products = Session::get('product');

        return view('user.checkout', ['products' => Session::get('product'), 'productsOrdered' => $cart->createStringAllProducts($products), 'totalPrice'=>$cart->totalCart($products)]);
    }

    public function placeOrder(StoreOrders $request) {

        $validateInput = $request->validated();

        $order = Orders::create($validateInput);

        if(Auth::check()) {

            $order->user_id = auth::user()->id;
            $order->save();
        }

        $cart = resolve(Cart::class);
        $cart->decrementProductsStockAndEmptyCart();

        return redirect()->route('user.viewCart');
    }

    public function increaseQuantity($id) {

        $cart = resolve(Cart::class);
        $cart->increaseQuantity($id);

        return redirect()->route('user.viewCart');
    }

    public function decreaseQuantity($id) {

        $cart = resolve(Cart::class);
        $cart->decreaseQuantity($id);

        return redirect()->route('user.viewCart');
    }

    public function removeFromCart($id) {

        $cart = resolve(Cart::class);
        $cart->removeItem($id);

        return redirect()->route('user.viewCart');
    }

    public function searchForProducts(Request $request) {

        $search = $request->validate([
            'name' => 'bail|required|min:1'
        ]);

        $found = Products::where( 'name', 'Like', '%' .$search['name']. '%')->get();

        if($found->isEmpty()) {

            Session::flash('status', 'not found');
            return redirect()->route('user.index');
        }

        return view('user.search',['found' => $found]);
    }

    public function contact() {
        return view('user.contact', ['products' => Products::all()->take(4)]);
    }

    public function profile() {
        return view('user.profile');
    }

    public function updateProfile(StoreProfile $request) {
        
        $input =  $request->validated();
        
        $user = User::findOrFail(auth::user()->id);

        $user->profile->fill($input);
        // dd($user->profile);
        $user->profile->save();

        return redirect()->route('user.profile');
    }

    public function history() {


        $userOrders = User::with('order')->whereKey(auth::user()->id)->first();

        // dd($userOrders->order);
        return view('user.history', ['orders' => $userOrders]);
    }
}
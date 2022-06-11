<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchValidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Orders;
use App\Models\User;
use App\Http\Requests\StoreOrders;
use App\Http\Requests\StoreProfile;
use App\Services\cart;
use App\Services\Search;

class UserController extends Controller
{
    public function __construct() {

        $this->middleware('auth')->only('profile', 'history');
    }

    public function index() {

        return view('user.index', ['products' => Products::all()]);
    }

    public function show($id) {

        $images = Products::with('imag')->findOrFail($id);
        
        $productImage = $images->imag;

        return view('user.show', ['product' => Products::with('reviews')->findOrFail($id),
                                   'reviews' => Products::withCount('reviews')->findOrFail($id),
                                   'productImage' => $productImage,
                                   ]);
    }

    public function addCartIndex(cart $cart, $id) {

        $product = Products::with('imag')->findOrFail($id);
        // $cart = resolve(Cart::class);
        // dd($product);
        
        if ($cart->checkItemStock($product)) {

            $cart->itemAvailableAddToCart($product, $id);
        }

        return redirect()->route('user.index');
    }

    public function addCartShow(Cart $cart, $id) {

        $product = Products::findOrFail($id);
        // $cart = resolve(Cart::class);

        if ($cart->checkItemStock($product)) {

            $cart->itemAvailableAddToCart($product, $id);
        }
        
        return redirect()->route('user.show', $product->id);
    }


    public function viewCart(Cart $cart) {

        $element = Session::get('product');
        // $cart = resolve(Cart::class);
        if(!$element) {
            Session::flash('cart', 'Your Cart is Empty');
        }

        return view('user.cart',['element' => $element, 'total' =>$cart->totalCart($element)]);
    }

    public function checkOut(Cart $cart) {

        // $cart = resolve(Cart::class);
        $products = Session::get('product');

        return view('user.checkout', ['products' => Session::get('product'), 'productsOrdered' => $cart->createStringAllProducts($products), 'totalPrice'=>$cart->totalCart($products)]);
    }

    public function placeOrder(Cart $cart, StoreOrders $request) {

        $validateInput = $request->validated();

        $order = Orders::create($validateInput);

        if(Auth::check()) {

            $order->user_id = auth::user()->id;
            $order->save();
        }

        // $cart = resolve(Cart::class);
        $cart->decrementProductsStockAndEmptyCart();

        return redirect()->route('user.viewCart');
    }

    public function increaseQuantity(Cart $cart, $id) {

        // $cart = resolve(Cart::class);
        $cart->increaseQuantity($id);

        return redirect()->route('user.viewCart');
    }

    public function decreaseQuantity(Cart $cart, $id) {

        // $cart = resolve(Cart::class);
        $cart->decreaseQuantity($id);

        return redirect()->route('user.viewCart');
    }

    public function removeFromCart(Cart $cart, $id) {

        // $cart = resolve(Cart::class);
        $cart->removeItem($id);

        return redirect()->route('user.viewCart');
    }

    public function searchForProducts(Search $search ,SearchValidate $request) {

        $userInput = $request->validated();

        $search = resolve(Search::class);
        $resultSearch = $search->byName($userInput);

        if($resultSearch->isEmpty()) {

            Session::flash('status', 'Product not found');
            return redirect()->route('user.index');
        }

        return view('user.search',['found' => $resultSearch]);
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
        $user->profile->save();

        return redirect()->route('user.profile');
    }

    public function history() {

        $userOrders = User::with('order')->whereKey(auth::user()->id)->first();

        return view('user.history', ['orders' => $userOrders]);
    }
}
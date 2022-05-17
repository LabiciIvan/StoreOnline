<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchValidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Orders;
use App\Models\User;
use App\Http\Requests\StoreOrders;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProfile;
use App\Models\ReviewsReplay;
use App\Services\Cart;
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

        $images = Products::with('image')->findOrFail($id);
        
        $productImage = $images->image;

        return view('user.show', ['product' => Products::with('reviews')->findOrFail($id),
                                   'reviews' => Products::withCount('reviews')->findOrFail($id),
                                   'productImage' => $productImage,
                                   ]);
    }

    public function addCartIndex($id) {

        $product = Products::findOrFail($id);
        $cart = resolve(Cart::class);
        
        if ($cart->checkItemStock($product)) {

            $cart->itemAvailableAddToCart($product, $id);
        }

        return redirect()->route('user.index');
    }

    public function addCartShow($id) {

        $product = Products::findOrFail($id);
        $cart = resolve(Cart::class);

        if ($cart->checkItemStock($product)) {

            $cart->itemAvailableAddToCart($product, $id);
        }
        
        return redirect()->route('user.show', $product->id);
    }


    public function viewCart() {

        $element = Session::get('product');
        $cart = resolve(Cart::class);

        return view('user.cart',['element' => $element, 'total' =>$cart->totalCart($element)]);
    }

    public function checkOut() {

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

    public function searchForProducts(SearchValidate $request) {

        $userInput = $request->validated();

        $search = resolve(Search::class);
        $resultSearch = $search->byName($userInput);

        if($resultSearch->isEmpty()) {

            Session::flash('status', 'not found');
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
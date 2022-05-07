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
class UserController extends Controller
{
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
        $notAdded = true;
        $quantity = 1;

        if ($product->stock == 0) {

            Session::flash('outStock', 'Item out of Stock');

            return redirect()->route('user.show', $product->id);
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

        return redirect()->route('user.show', $product->id);
    }


    public function viewCart() {

        $element = Session::get('product');
        $total = 0;

       if($element) {
        foreach ($element as $key => $value) {
            $total += $value['price'] * $value['quantity'];
        }
       }

        return view('user.cart',['element' => $element, 'total' => $total]);
    }

    public function checkOut() {

        $productsOrdered= ""; 
        $totalPrice = 0;
        foreach (Session::get('product') as $key => $value) {
            $productsOrdered .= $value['name'] .  " " . $value['quantity'] . "|";
            $totalPrice += $value['price'] * $value['quantity'];
        }
        return view('user.checkout', ['products' => Session::get('product'), 'productsOrdered' => $productsOrdered, 'totalPrice'=>$totalPrice]);
    }

    public function placeOrder(StoreOrders $request) {

        $validateInput = $request->validated();

        // dd(Auth::check());
        $order = Orders::create($validateInput);

        if(Auth::check()) {

            $order->user_id = auth::user()->id;
            $order->save();

        }

        foreach (Session::get('product') as $key => $value) {
            $product =  Products::findOrFail($value['id']);
            $product->stock = $product->stock - $value['quantity'];
            $product->save();
        }

        // Session::flush(); if using flush it will delete session and logut user NOT GOOD
        Session::forget('product');
        Session::flash('status', 'Your order is placed, thanks for shoping at Store Online');
        return redirect()->route('user.viewCart');
    }

    public function increaseQuantity($id) {

        foreach (Session::get('product') as $key => $value) {
            if($value['id'] == $id) {
                ++$value['quantity'];
                $value['totalPrice'] = $value['quantity'] * $value['price'];
                Session::put('product.'.$key, $value);
            }   
        }
        return redirect()->route('user.viewCart');
    }

    public function decreaseQuantity($id) {

        foreach (Session::get('product') as $key => $value) {
            if($value['id'] == $id && $value['quantity'] > 1) {
                --$value['quantity'];
                $value['totalPrice'] = $value['quantity'] * $value['price'];    
                Session::put('product.'.$key, $value);
            }
        }
        return redirect()->route('user.viewCart');
    }

    public function removeFromCart($id) {

        foreach (Session::get('product') as $key => $value) {
            if($value['id'] == $id) {
                Session::pull('product.'.$key);
            }
        }
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
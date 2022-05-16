<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Reviews;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreReplay;
use App\Models\Replay;

class AdminController extends Controller
{

    public function __construct()
    {
    
         $this->middleware('auth');
         $this->middleware('admin');

    }

    public function product() {

        // authorize checks for role of admin 
        $this->authorize('isAdmin');

        return view('admin.product', ['products' => Products::all()]);
    }

    public function addProduct(StoreProduct $request) {

        $this->authorize('isAdmin');

        $validateInput = $request->validated();

        $product = Products::create($validateInput);
        
        return redirect()->route('admin.product');
    }

    public function updateProduct(StoreProduct $request, $id) {

        $this->authorize('isAdmin');

   
        $validateInput = $request->validated();

        $product = Products::findOrFail($id);
        $product->fill($validateInput);
        $product->save($validateInput);

        Session::flash('status', 'Changes have been saved');

        return redirect()->route('admin.productDetails', $id);

    }

    public function deleteProduct($id) {

        $this->authorize('isAdmin');

        $product = Products::with('reviews')->findOrFail($id);

        $product->reviews()->delete();
        $product->delete();

        return redirect()->route('admin.product');
    }

    public function replayToReview(StoreReplay $request, $idReview, $idProduct) {

        $userInput = $request->validated();
        $review = Reviews::findOrFail($idReview);

        $replay = new Replay($userInput);
        $replay->products_id = $idProduct;
        $replay->userName = 'ADMIN';
        $replay->user_id = auth()->user()->id;
        $review->replay()->save($replay);

        return redirect()->route('admin.productDetails', $idProduct);

    }

    public function deleteReview($idReview, $idProduct) {

        $this->authorize('isAdmin');

        $review = Reviews::findOrFail($idReview);
        if ($review->replay()->exists()) {
            $review->replay()->delete();
        }
        $review->delete();

        return redirect()->route('admin.productDetails', $idProduct);
    }

    public function deleteReplayReview($idReplay, $idProduct) {
        
        $replay = Replay::findOrFail($idReplay);
    
        $replay->delete();

        return redirect()->route('admin.productDetails', $idProduct);
    }

    public function productDetails($id) {

        $this->authorize('isAdmin');

        return view('admin.details', ['product' => Products::with('reviews')->findOrFail($id)]);

    }

    public function order() {

        $this->authorize('isAdmin');

        $confirmedOrders = Orders::where('confirmed', 1)->get();
        $order = Orders::where('confirmed', 0)->get();
        // dd($confirmedOrders);

        return view('admin.order', ['order' => $order, 'confirmedOrders' =>$confirmedOrders]);
    }

    public function confirmOrder($orderId) {

        $order = Orders::findOrFail($orderId);
        $order->confirmed = true;
        $order->save();

        return redirect()->route('admin.order');

    }
    
}

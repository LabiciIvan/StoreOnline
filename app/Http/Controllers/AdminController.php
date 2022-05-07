<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Reviews;
use App\Http\Requests\StoreProduct;

class AdminController extends Controller
{

    public function __construct()
    {
    
         $this->middleware('auth');
         $this->middleware('admin');
    }

    public function product() {

        return view('admin.product', ['products' => Products::all()]);
    }

    public function addProduct(StoreProduct $request) {

        $validateInput = $request->validated();

        $product = Products::create($validateInput);
        
        return redirect()->route('admin.product');
    }

    public function updateProduct(StoreProduct $request, $id) {

   
        $validateInput = $request->validated();

        $product = Products::findOrFail($id);

     

        $product->fill($validateInput);
        $product->save($validateInput);

        Session::flash('status', 'Changes have been saved');

        return redirect()->route('admin.productDetails', $id);

    }

    public function deleteProduct($id) {

        $product = Products::with('reviews')->findOrFail($id);

        $product->reviews()->delete();
        $product->delete();

        return redirect()->route('admin.product');
    }

    public function deleteReview($idReview, $idProduct) {
        $review = Reviews::findOrFail($idReview);
        $review->delete();

        
        return redirect()->route('admin.productDetails', $idProduct);
    }

    public function productDetails($id) {

        return view('admin.details', ['product' => Products::with('reviews')->findOrFail($id)]);

    }

    public function order() {
        return view('admin.order', ['order' => Orders::all()]);
    }
    
}

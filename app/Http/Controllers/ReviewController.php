<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Reviews;
use App\Http\Requests\StoreReview;
use App\Models\Replay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeReview(StoreReview $request, $id) {

        $validate = $request->validated();
        
    
        
        $product = Products::findOrFail($id);
        $review = new Reviews($validate);
        $review->user_id = auth()->user()->id;

        $product->reviews()->save($review);
        

        return redirect()->route('user.show', $id);

    }

    public function deleteParentReview($idReview, $idProduct) {
        
        $review = Reviews::findOrFail($idReview);
   
        if($review->replay()->exists()) {

            $review->replay()->delete();
        } 

        $this->authorize('reviews.delete', $review);
            
        $review->delete();
            
        return redirect()->route('user.show', $idProduct);
    }

}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Reviews;
use App\Http\Requests\StoreReview;
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

    public function removeReview($idReview) {
        
        $review = Reviews::findOrFail($idReview);
        
        
        // dd($user);
        
        if (Gate::denies('delete-review', $review)) {
                abort(403);
            }
            
            // dd($review);
            $review->delete();
            
        return redirect()->route('user.index');
    }

}

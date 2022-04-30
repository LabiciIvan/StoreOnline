<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Reviews;
use App\Http\Requests\StoreReview;


class ReviewController extends Controller
{

    public function storeReview(StoreReview $request, $id) {

        $validate = $request->validated();

        $product = Products::findOrFail($id);
        $review = new Reviews($validate);
        $product->reviews()->save($review);

        return redirect()->route('user.show', $id);

    }

}

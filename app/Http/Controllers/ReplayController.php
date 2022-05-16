<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplay;
use App\Models\Replay;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReplayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeReplay(StoreReplay $request, $idReview, $idProduct) {

        $this->authorize('replay.store');

        $content = $request->validated();

        $review = Reviews::findOrFail($idReview);

        $replay = new Replay($content);
        $replay->products_id = $idProduct;
        $replay->userName = auth()->user()->name;
        $replay->user_id = auth()->user()->id;

        $review->replay()->save($replay);

        return redirect()->route('user.show', $idProduct);

    }

    public function deleteReplay($idReplay, $productId) {

        
        $replay = Replay::findOrFail($idReplay);

        $this->authorize('replay.delete', $replay);

        $replay->delete();

        return redirect()->route('user.show', $productId);

    }
}

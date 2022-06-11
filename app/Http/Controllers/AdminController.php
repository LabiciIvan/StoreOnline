<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Reviews;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreReplay;
use App\Models\Imag;
use App\Models\Replay;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

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

        if($request->hasFile('imageOne') || $request->hasFile('imageTwo') || $request->hasFile('imageThree')) {
            
            $image = new Imag(); // create a model

            if ($request->hasFile('imageOne')) { // add every uploaded image path to a Image model field

                // $imageInput = $request->file('imageOne');
                // $image->pathOne =  $imageInput->store('public/pictures');
                // $image->save();

                $file = $request->file('imageOne');

                $name = hash('md5', $file->getClientOriginalName());
                // $img = Image::make($file)->encode()->save(storage_path('app/public/pictures/' . $name . '.jpg')); // SAVE LOCALY
                $img = Image::make($file)->encode()->stream();
                
                $pathToImage = 'public/pictures/' . $name . '.jpg';

                Storage::disk('s3')->put($pathToImage, $img->__toString());

                $image->pathOne = $pathToImage;
                $image->save();
 
      
            }
            if ($request->hasFile('imageTwo')) {

                $file = $request->file('imageTwo');

                $name = hash('md5', $file->getClientOriginalName());
                // $img = Image::make($file)->resize('100','100')->encode()->save(storage_path('app/public/pictures/' . $name . '.jpg'));
                $img = Image::make($file)->encode()->stream();

                $pathToImage = 'public/pictures/' . $name . '.jpg';

                Storage::disk('s3')->put($pathToImage, $img->__toString());
                $image->pathTwo = $pathToImage;
                $image->save();
    
            }
            if ($request->hasFile('imageThree')) {

                // $imageInput = $request->file('imageThree');
                // $image->make($imageInput);
                // dd($image);
                // $image->pathThree = $request->file('imageThree')->store('products', 's3');


                $file = $request->file('imageThree');

                $name = hash('md5', $file->getClientOriginalName());
                // $img = Image::make($file)->encode()->save(storage_path('app/public/pictures/' . $name . '.jpg'));

                $img = Image::make($file)->encode()->stream();


                $pathToImage = 'public/pictures/' . $name . '.jpg';

                Storage::disk('s3')->put($pathToImage, $img->__toString());
                $image->pathThree = $pathToImage;
                $image->save();
                
            }

          
            $product->imag()->save($image);
        }
        
        return redirect()->route('admin.product');
    }


    public function changeImage(Request $request, $id, $path) {

        if($request->hasFile('image')) {
            $product = Products::findOrFail($id);

            if($product->imag) {

                if($product->imag->$path) {
                    Storage::disk('s3')->delete($product->imag->$path);

                    // Storage::delete($product->imag->$path);

                }
       
                // $product->imag->$path = $request->file('image')->store('products', 's3');
                // $product->imag->save();

                $file =  $request->file('image');
                $name = hash('md5', $file->getClientOriginalName());
                // $img = Image::make($file)->encode()->save(storage_path('app/public/pictures/' . $name . '.jpg'));


                $pathToImage = 'public/pictures/' . date("Y-m-d H:i:s") . '-' . $name . '.jpg';

                $img = Image::make($file)->encode()->stream();

                Storage::disk('s3')->put($pathToImage, $img->__toString());

                $product->imag->$path = $pathToImage;
                $product->imag->save();
            } else {
                $image = new Imag();

                $file =  $request->file('image');
                $name = hash('md5', $file->getClientOriginalName());
                // $img = Image::make($file)->encode()->save(storage_path('app/public/pictures/' . $name . '.jpg'));


                $pathToImage = 'public/pictures/' . time() . '-' . $name . '.jpg';

                $img = Image::make($file)->encode()->stream();

                Storage::disk('s3')->put($pathToImage, $img->__toString());

                $image->$path = $pathToImage;
                

                $image->save();
                $product->imag()->save($image);
            }
        }
        return redirect()->route('admin.productDetails', $id);
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

        $product = Products::with('reviews', 'replay')->findOrFail($id);

        $product->replay()->delete();
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

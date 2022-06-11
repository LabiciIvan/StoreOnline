<?php

namespace app\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Products;

class Cart {

  public function totalCart($element) {

        $total = 0;

      if($element) {
        foreach ($element as $key => $value) {
            $total += $value['price'] * $value['quantity'];
        }
      }

      return $total;
  }


  public function createStringAllProducts($products) {

      $productsOrdered= ""; 

      foreach ($products as $key => $value) {
          $productsOrdered .= $value['name'] .  " " . $value['quantity'] . "|";
      }

      return $productsOrdered;
  }


  public function decrementProductsStockAndEmptyCart() {

      foreach (Session::get('product') as $key => $value) {
        $product =  Products::findOrFail($value['id']);
        $product->stock = $product->stock - $value['quantity'];
        $product->save();
      }
      
        Session::forget('product');
        Session::flash('status', 'Your order is placed, thanks for shoping at Store Online');
    }
    
    
    public function increaseQuantity($id) {

      foreach (Session::get('product') as $key => $value) {
        if($value['id'] == $id) {
            ++$value['quantity'];
            $value['totalPrice'] = $value['quantity'] * $value['price'];
            Session::put('product.'.$key, $value);
        }   
    }

    }


    public function decreaseQuantity($id) {

        foreach (Session::get('product') as $key => $value) {
          if($value['id'] == $id && $value['quantity'] > 1) {
              --$value['quantity'];
              $value['totalPrice'] = $value['quantity'] * $value['price'];    
              Session::put('product.'.$key, $value);
          }
      }
    }


    public function removeItem($id) {
      
      foreach (Session::get('product') as $key => $value) {
          if($value['id'] == $id) {
              Session::pull('product.'.$key);
          }
      }
    }

    public function checkItemStock($product) {

      if ($product->stock == 0) {

          Session::flash('outStock', 'Item out of Stock');
          
          return false;
      }
      return true;
    }

    public function itemAvailableAddToCart($product, $id) {

      $notAdded = true;
      $quantity = 1;

      if (isset($product['imag']['pathOne'])) {
        $toSession = [
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'stock' => $product->stock,
          'quantity' => $quantity,
          'totalPrice' => $quantity * $product->price,
          'image' =>$product['imag']['pathOne']
  
      ];
      } else {
        
        $toSession = [
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'stock' => $product->stock,
          'quantity' => $quantity,
          'totalPrice' => $quantity * $product->price,
      ];
      }
      // dd($product['imag']['pathOne']->exists());

    // dd($toSession);

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
    }
}
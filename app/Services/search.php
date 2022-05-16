<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Products;

class Search {

  public function byName($search) {

      return Products::where( 'name', 'Like', '%' .$search['name']. '%')->get();
  }

}
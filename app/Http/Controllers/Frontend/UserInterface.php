<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserInterface extends Controller
{
   public function user_interface()
   {
    $products=product::all();
    return view('Interface.index',compact('products'));
   }
   public function user_interface_details($id)
   {
      
    $product=product::find($id);
    return view('Interface.details',compact('product'));
   }
}

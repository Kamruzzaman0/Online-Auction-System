<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\category;
use App\Models\payment;
use App\Models\product;
use App\Models\sub_category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductController extends Controller
{
    public function admin_product()
    {
        $products = product::all();
        $categories = category::all();
        $sub_categories = sub_category::all();
        return view('Backend.Layout.Product.product', compact('products', 'categories','sub_categories'));
    }
    public function admin_product_add(Request $request)
    {
        //dd($request->all());
        $filename ='';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = date('Ymdhms') .rand(1,100000). '.' . $file->getClientOriginalExtension();
                $file->storeAs('Product', $filename);
            }
        }
        $filename1 ='';
        if ($request->hasFile('auth_image')) {
            $file = $request->file('auth_image');
            if ($file->isValid()) {
                $filename1 = date('Ymdhms') .rand(1,100000). '.' . $file->getClientOriginalExtension();
                $file->storeAs('Auth.image', $filename1);
            }
        }
        // dd($filename);
        product::create([
            'image'=>$filename,
            'cate_id'=>$request->cate_id,
            'sub_cate_id'=>$request->sub_cate_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'year'=>$request->year,
            'mini_bid'=>$request->mini_bid,
            'bid_end'=>$request->bid_end,
            'bid_time'=>$request->bid_time,
            'auth_image'=>$filename1,

        ]);                    
        return redirect()->route('admin_product')->with('success', 'Create Successfully');
    }
    public function admin_product_edit($id)
    {
        $categories= category::all();
        $sub_categories= sub_category::all();
        $products = product::find($id);
        return view('Backend.Layout.Product.product_edit', compact('products','categories','sub_categories'));
    }
    public function admin_product_update(Request $request, $id)
    {

        try{
            $product=product::find($id);
        $des = public_path('\\uploads\\Product\\' . $product->image);
        $des1 = public_path('\\uploads\\Auth.image\\' . $product->auth_image);
        $filename = $product->image;
        $filename1 = $product->auth_image;
        if ($request->hasFile('image')) {
            if (File::exists($des)) {
                File::delete($des);
            }
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = date('Ymdhms') . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Product', $filename);
            }
        } 
        if ($request->hasFile('auth_image')) {
            if (File::exists($des1)) {
                File::delete($des1);
            }
            $file = $request->file('auth_image');
            if ($file->isValid()) {
                $filename1 = date('Ymdhms') . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Auth.image', $filename1);
            }
        }    
        $product->update([
            'image'=>$filename,
            'auth_image'=>$filename1,
            'cate_id'=>$request->cate_id,
            'sub_cate_id'=>$request->sub_cate_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'year'=>$request->year,
            'mini_bid'=>$request->mini_bid,
            'bid_end'=>$request->bid_end,
            'bid_time'=>$request->bid_time,
        ]);
        return redirect()->route('admin_product')->with('success', 'Update Successfully');
    }
    catch(Exception $e){
     return redirect()->back()->with('error', 'Field Value Required');
    }
    }
    public function admin_product_delete($id)
    {
        $product = product::find($id);
        $des = public_path('\\uploads\\Product\\' . $product->image);
        $des1 = public_path('\\uploads\\Auth.image\\' . $product->auth_image);
       
        
        
        //dd($des);
        
        if (File::exists($des)) {
            File::delete($des);
        }
        if (File::exists($des1)) {
            File::delete($des1);
        }
        $bids = Bid::where('item_id',$product->id)->get();
        //dd($bids);
        foreach ($bids as  $bid) {
            $bid ->delete();
        }
        $pays =payment::where('product_id',$product->id)->get();
        //dd($pays);
            foreach ($pays as  $pay) {
                $pay ->delete();
            }
            $product = product::find($id)->delete();

            //$bid = Bid::where('item_id',$product->id)->delete();
           // dd($bid);
        
            return redirect()->route('admin_product')->with('error', 'Delete Successfully');
    }
}

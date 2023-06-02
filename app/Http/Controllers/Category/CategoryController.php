<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\category;
use App\Models\payment;
use App\Models\product;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function admin_category_list()
    {
        $categories = category::all() ;
        return view('Backend.Layout.Category.category_list', compact('categories'));
    }
    public function admin_category_add(Request $request)
    {
        category::create([
            'name'=>$request->name,
            'description' =>$request->description,
        ]);
        return redirect()->back()->with('success', 'Create Successfully');
    }
    public function admin_category_edit($id)
    {
        $category = category::find($id) ;
        return view('Backend.Layout.Category.category_edit', compact('category'));
    }
    public function admin_category_update(Request $request, $id)
    {
        $category = category::find($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin_category_list')->with('success', 'Update Successfully');
    }
    public function admin_category_delete($id)
    {
        $category = category::findOrFail($id);
        $sub_categories = sub_category::where('cate_id', $category->id)->get();
        // dd($category);

        
        if($sub_categories->isEmpty())
        {
            // dd($category);
            $category->delete(); 
        }
        else{
          
            foreach ($sub_categories as  $sub_category) {
                $products = product::where('sub_cate_id',$sub_category->id)->get();
                foreach ($products as  $product) {
                   // dd($products);
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
                $product->delete();
                //$bid = Bid::where('item_id',$product->id)->delete();
             $sub_category->delete();
            $category->delete();
        }
    }
}
        return redirect()->route('admin_category_list')->with('error', 'Delete Successfully');
    }
}

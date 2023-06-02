<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\category;
use App\Models\payment;
use App\Models\product;
use App\Models\sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function admin_sub_category_list()
    {
        $sub_categories = sub_category::all();
        $categories = category::all();
        return view('Backend.Layout.Sub_Category.sub_cat_list' , compact('sub_categories','categories'));
    }
    public function admin_sub_category_add(Request $request)
    {
        sub_category::create([
            'name'=>$request->name,
            'cate_id'=>$request->cate_id,
            'description' =>$request->description,
        ]);
        return redirect()->back()->with('success', 'Create Successfully');
    }
    public function admin_sub_category_edit($id)
    {
        $categories= category::all();
        $sub_category = sub_category::find($id);
        return view('Backend.Layout.Sub_Category.sub_cat_edit', compact('sub_category','categories'));
    }
    public function admin_sub_category_update(Request $request, $id)
    {
        $sub_category = sub_category::find($id);
        $sub_category->update([
            'name' => $request->name,
            'cate_id'=>$request->cate_id,
            'description' => $request->description,
        ]);
        return redirect()->route('admin_sub_category_list')->with('success', 'Update Successfully');
    }
    public function admin_sub_category_delete($id)
    {
        $sub_cat = sub_category::findOrFail($id);
        $products = product::where('sub_cate_id',$sub_cat->id)->get();
        foreach ($products as  $product) {
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
            $product ->delete();
        }
        $sub_cat->delete();

        return redirect()->route('admin_sub_category_list')->with('error', 'Delete Successfully');
    }
}

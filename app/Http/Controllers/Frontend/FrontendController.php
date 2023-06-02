<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bid as ModelsBid;
use App\Models\Bid;
use App\Models\category;
use App\Models\payment;
use App\Models\product;
use App\Models\sub_category;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\check;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\Console\Input\Input;

class FrontendController extends Controller
{
    //login and registration for customer and seller

    public function user_login()
    {
        return view('Frontend.Login.customerlogin');
    }
    public function seller_login()
    {
        return view('Frontend.Login.sellerlogin');
    }
    public function login1(Request $request)
    {
       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 3) {
                return redirect()->route('customer_dashboard')->with('success', 'Login Successfully');
            } else {
                return redirect()->back()->with('error', 'Your are not Authorized');
            }
        }

        return redirect()->back()->with('error', 'Login Failed');
    }
    public function login_S(Request $request)
    {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
       

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 2) {
                return redirect()->route('seller_dashboard')->with('success', 'Login Successfully');
            } else {
                return redirect()->back()->with('error', 'Your are not Authorized');
            }
        }
        return redirect()->back()->with('error', 'Login Failed');
    }
    public function registration(Request $request)
    {
        if (User::where('email', $request->get('email'))->exists()) {
            return back()->with('error', ' Registration Failed');
        } else {
            $filename = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = date('Ymdhms') . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('Profile', $filename);
                }
            }
            User::create([
                'name' => $request->name,
                'role_id' => 3,
                'email' => $request->email,
                'address' => $request->address,
                'image' => $filename,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),

            ]);
            return redirect()->back()->with('success', 'Congratulations! Customer Registration Successfully');
        }
    }
    public function registration_s(Request $request)
    {
        if (User::where('email', $request->get('email'))->exists()) {
            return back()->with('error', ' Registration Failed');
        } else {
            $filename = '';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = date('Ymdhms') . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('Profile', $filename);
                }
            }
            User::create([
                'name' => $request->name,
                'role_id' => 2,
                'email' => $request->email,
                'address' => $request->address,
                'image' => $filename,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),

            ]);
            return back()->with('success', 'Congratulations! Seller Registration Successfully');
        }
    }
    public function customer_registration()
    {
        return view('Frontend.Login.cus_reg');
    }
    public function seller_registration()
    {
        return view('Frontend.Login.seller_reg');
    }

  

    //Customer
  
    public function customer_details($id)
    {
       
     //    $product = product::find($id);
    //    // dd($product->bid_end);
     //    $today = Carbon::now();
    //     //dd($today);
     //    $startTime = Carbon::parse($today);
     //    $finishTime = Carbon::parse($product->bid_end);
    //     $test = $finishTime->addHours(24);
    //     $diff = $test->diff($startTime);
    //     // $total = $startTime->diff($finishTime)->format('%D %H:%I:%S');
    //     if ($diff->days >= 1){
    //         $total = $test->diffForHumans($startTime);
    //     }
    //     else {
    //     //$total = $diff->format('%h hours, %i minutes, %s seconds'); // format the time difference as "X hours, Y minutes, Z seconds"
    //         $total = $test->diff($startTime)->format('%H:%I:%S')." ago";
    //      }
    // $total = $finishTime->diffForHumans($startTime);
    //$total1= $total1->addHours(10)->addMinutes(15)->addSeconds(20)->toTimeString();
    //$total=gmdate('h:m:s', $totalDuration);
   // $total=Carbon::parse($totalDuration)->addDays(7)->diffForHumans();
        $product = product::find($id);
        $to = Carbon::now();
        $finishTime = Carbon::parse($product->bid_end);
        $time =$product->bid_time;
        list($hours, $minutes) = explode(':', $time);
       // dd($hours, $minutes);
        $end = $finishTime->addHours($hours)->addMinutes($minutes);
       // dd($end);
        //dd($end);
        $bids = Bid::where('item_id', $product->id)->orderBy('bid_a', 'desc')->get();
        $max = Bid::where('item_id', $product->id)->max('bid_a');
        //dd($product->bid_time);

       
        // dd($product->id,$bids,$max);
        return view('Frontend.Customer.Layout.details', compact('product', 'bids','to','end','max'));
    }

    public function get_time($id){
        $product = product::find($id);
       // dd($product->bid_end);
        $today = Carbon::now();
        //dd($today);
        $startTime = Carbon::parse($today);
        $finishTime = Carbon::parse($product->bid_end);
        $time =$product->bid_time;
        list($hours, $minutes) = explode(':', $time);
        $test = $finishTime->addHours($hours)->addMinutes($minutes);
        $diff = $test->diff($startTime);
        // $total = $startTime->diff($finishTime)->format('%D %H:%I:%S')." left";
        if ($diff->days < 1){
            $total = $test->diff($startTime)->format('%h hours, %i minutes, %s seconds');
        }

        return response()->json([
            'status' =>200,
            'total' => $total
        ]);
    }

    public function customer_dashboard()
    {
        $products = product::all();
        return view('Frontend.Customer.Layout.dashboard', compact('products'));
    }
    public function customer_profile($id)
    {
        $user = User::find($id);

        return view('Frontend.Customer.Layout.customer_profile', compact('user'));
    }
    public function customer_update_info()
    {
        $user =User::where('id',auth()->user()->id)->first();
      return view('Frontend.Customer.Layout.update_password',compact('user'));
    }
    public function customer_updated_info(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $des = public_path('\\uploads\\Profile\\' . $user->image);
        $filename = $user->image;
        if ($request->hasFile('image')) {
            if (File::exists($des)) {
                File::delete($des);
            }
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = date('Ymdhms') . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Profile', $filename);
            }
        }
       //dd( $user);
       if($request->password == null){
        return redirect()->back()->with('error', 'Password Required');
       }
       else{
        $user->update([
            'name' => $request->name,
            'role_id' => 3,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $filename,
            'address' => $request->address,
            'password' =>  Hash::make($request->password),

        ]);
        return redirect()->route('customer_dashboard')->with('success', 'Congratulations! Profile Updated Successfully');
       }
    }
    public function customer_bid(Request $request, $id, $p_id)
    {

        $today = Carbon::today();
        $product = product::find($p_id);
        $to = Carbon::parse($today)->format('Y-m-d');
        $end = Carbon::parse($product->bid_end)->format('Y-m-d');
       // dd($to,$end);
        $bids =Bid::where('item_id', $p_id)->where('buyer_id', Auth::user()->id)->first();
        //dd($request->bid_a);
            if ($to <= $end) {
                if ($request->bid_a > $product->mini_bid) {
                    $bid = Bid::where('item_id', $p_id)->where('buyer_id', $id)->exists();

                    // dd($bid);
                    if ($bid) {
                        // dd($request->bid_a, $bids->bid_a);
                        if($request->bid_a > $bids->bid_a){
                            //dd($bid);
                            Bid::where('buyer_id', $id)->where('item_id', $p_id)->update([
                                // 'seller_id'=> $product->user3->id,
                                'buyer_id' => $id,
                                'item_id' => $p_id,
                                'bid_a' => $request->bid_a,
                                'bid_t' => $today,
                            ]);
                            return redirect()->back()->with('success', 'Congratulations! Amount Updated Successfully');
                        }
                        else{
                            //dd($bid);
                            return redirect()->back()->with('error', ' Amount Is Equal or Less Than Previous Amount You Enter');
                        }
                    } else {
                        Bid::create([
                            //'seller_id'=> $p_id->user3->id,
                            'buyer_id' => $id,
                            'item_id' => $p_id,
                            'bid_a' => $request->bid_a,
                            'bid_t' => $today,
                        ]);
    
                        return redirect()->back()->with('success', 'Congratulations! Bided Successfully');
                    }
                } else {
                    return redirect()->back()->with('error', ' Bided Amount Less Than Given Amount');
                }
            }
             else {
                //dd($to <= $end);
                return redirect()->back()->with('error', ' Time Finished');
            }
       
    }
    public function customer_biding_info($id)
    {
        $bidss = Bid::orderBy('bid_a', 'desc')->get();

        $bids = Bid::where('buyer_id', $id)->get();
        $products=[];
        foreach($bids as $bid){

            $itemId = $bid->item_id;
            if(product::where('id', $itemId)->exists()){
                
                $product = product::where('id', $itemId)->first();
                array_push($products,$product);
            }
        //    dd($bids,$product );
        }
    //   dd($products);
        return view('Frontend.Customer.Layout.biding_info',compact('products','bidss'));
       
    }
    public function customer_payment($id)
    {
        $user = User::find($id);
       $payments = payment::where('buyer_id', $user->id)->get();
       //dd($payments);
       return view('Frontend.Customer.Layout.payment',compact('payments'));

    }







    //Seller
    public function seller_profile($id)
    {
        $user = User::find($id);
        // dd($user);
        return view('Frontend.Seller.Layout.profile', compact('user'));
    }
    public function seller_dashboard()
    {
        return view('Frontend.Seller.Layout.dashboard');
    }
    public function seller_bider_list($id)
    {
        
        $products = product::where('seller_id', $id)->get();
        $bids = Bid::orderBy('bid_a', 'desc')->get();


      
//dd($max);
        //dd($bids);
        // dd($products);
        return view('Frontend.Seller.Layout.bider_list', compact('products', 'bids'));
    }
    public function seller_customer()
    {
        $users = User::where('role_id', 3)->get();
        return view('Frontend.Seller.Layout.customer', compact('users'));
    }

    public function seller_category($id)
    {
        $categories = category::where('seller_id', $id)->get();
        return view('Frontend.Seller.Layout.Product.category', compact('categories'));
    }

    public function seller_category_create(Request $request)
    {
        category::create([
            'name' => $request->name,
            'seller_id' => auth()->user()->id,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Create Successfully');
    }
    public function seller_category_edit($id)
    {
        $category = category::find($id);
        return view('Frontend.Seller.Layout.Product.category_edit', compact('category'));
    }
    public function seller_category_update(Request $request, $id)
    {
        $category = category::find($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('seller_category', auth()->user()->id)->with('success', 'Update Successfully');
    }
    public function seller_category_delete($id)
    {
        $category = category::findOrFail($id);
        $sub_categories = sub_category::where('cate_id', $category->id)->get();
        // dd($category);


        if ($sub_categories->isEmpty()) {
            // dd($category);
            $category->delete();
        } else {

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
    
        return redirect()->route('seller_category', auth()->user()->id)->with('error', 'Delete Successfully');
    }
    public function seller_sub_category($id)
    {
        $sub_categories = sub_category::where('seller_id', $id)->get();
        $categories = category::where('seller_id', $id)->get();
        return view('Frontend.Seller.Layout.Product.sub_category', compact('sub_categories', 'categories'));
    }
    public function seller_sub_category_create(Request $request)
    {
        sub_category::create([
            'seller_id' => auth()->user()->id,
            'name' => $request->name,
            'cate_id' => $request->cate_id,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Create Successfully');
    }
    public function seller_sub_category_edit($id)
    {
        $categories = category::where('seller_id', auth()->user()->id)->get();
        $sub_category = sub_category::find($id);
        return view('Frontend.Seller.Layout.Product.sub_category_edit', compact('sub_category', 'categories'));
    }
    public function seller_sub_category_update(Request $request, $id)
    {
        $sub_category = sub_category::find($id);
        $sub_category->update([
            'name' => $request->name,
            'cate_id' => $request->cate_id,
            'description' => $request->description,
        ]);
        return redirect()->route('seller_sub_category', auth()->user()->id)->with('success', 'Update Successfully');
    }
    public function seller_sub_category_delete($id)
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

        return redirect()->route('seller_sub_category', auth()->user()->id)->with('error', 'Delete Successfully');
    }
    public function seller_product($id)
    {
        $products = product::where('seller_id', auth()->user()->id)->get();
        $categories = category::where('seller_id', auth()->user()->id)->get();
        $sub_categories = sub_category::where('seller_id', auth()->user()->id)->get();
        return view('Frontend.Seller.Layout.Product.product', compact('products', 'categories', 'sub_categories'));
    }
    public function seller_product_create(Request $request)
    {
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
            'seller_id' => auth()->user()->id,
            'image' => $filename,
            'cate_id' => $request->cate_id,
            'sub_cate_id' => $request->sub_cate_id,
            'name' => $request->name,
            'description' => $request->description,
            'year' => $request->year,
            'mini_bid' => $request->mini_bid,
            'bid_end' => $request->bid_end,
            'bid_time'=>$request->bid_time,
            'auth_image'=>$filename1,


        ]);
        return redirect()->route('seller_product', auth()->user()->id)->with('success', 'Create Successfully');
    }
    public function seller_product_edit($id)
    {
        $categories = category::where('seller_id', auth()->user()->id)->get();
        $sub_categories = sub_category::where('seller_id', auth()->user()->id)->get();
        $products = product::find($id);
        return view('Frontend.Seller.Layout.Product.product_edit', compact('products', 'categories', 'sub_categories'));
    }
    public function seller_product_update(Request $request, $id)
    {
        try {
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
                'image' => $filename,
                'auth_image'=>$filename1,
                'cate_id' => $request->cate_id,
                'sub_cate_id' => $request->sub_cate_id,
                'name' => $request->name,
                'description' => $request->description,
                'year' => $request->year,
                'mini_bid' => $request->mini_bid,
                'bid_end' => $request->bid_end,
                'bid_time'=>$request->bid_time,

            ]);
            return redirect()->route('seller_product', auth()->user()->id)->with('success', 'Update Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Field Value Required');
        }
    }
    public function seller_product_delete($id)
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

        return redirect()->route('seller_product', auth()->user()->id)->with('error', 'Delete Successfully');
    }
    public function seller_payment($id)
    {
         $user = User::find($id);
       $payments = payment::where('seller_id', $user->id)->get();
       //dd($payments);
       return view('Frontend.Seller.Layout.payment',compact('payments'));
    }
}

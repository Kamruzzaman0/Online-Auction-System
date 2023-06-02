<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\WinnierMail;
use App\Models\Bid;
use App\Mail\WinnerMail;
use App\Models\category;
use App\Models\payment;
use App\Models\pdf as ModelsPdf;
use App\Models\product;
use App\Models\sub_category;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\IsEmpty;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Mail;

class BackendController extends Controller
{
    public function login0(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin_dashboard')->with('success', 'Login Successfully');
            } else {
                return redirect()->back()->with('error', 'Your are not Authorized');
            }
        }

        return redirect()->back()->with('error', 'Login Failed');
    }
    public function admin_login()
    {
        return view('Backend.Login.login');
    }
    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout Successfully');
    }
    public function admin_dashboard()
    {
        $user_c = User::where('role_id', 3)->get();
        //dd($user_c);
        $user_s = User::where('role_id', 2)->get();
        $products = product::all();
        $payments = payment::all();
        $categories = category::all();
        $sub_categories = sub_category::all();

        //dd( $key12 ,$key1,$products);
        return view('Backend.Layout.dashboard', compact('user_c', 'user_s', 'products', 'payments', 'categories', 'sub_categories'));
    }
    public function admin_bider_list()
    {
        $products = product::all();
        $bids = Bid::orderBy('bid_a', 'desc')->get();

        //dd($bids);
        // dd($products);
        return view('Backend.Layout.bider_list', compact('products', 'bids'));
    }


    public function admin_customer()
    {
        $users = User::where('role_id', 3)->get();
        return view('Backend.Layout.customer', compact('users'));
    }
    public function admin_customerlist_delete($id)
    {
        $user = User::find($id);
        $des = public_path('\\uploads\\Profile\\' . $user->image);
        //dd($des);

        if (File::exists($des)) {
            File::delete($des);
        }
        $user = User::find($id)->delete();
        return redirect()->route('admin_customer')->with('error', 'Delete Successfully');
    }
    public function admin_payment()
    {

        $payments = payment::all();
        return view('Backend.Layout.payment', compact('payments'));
    }

    public function admin_payment_status(Request $request, $id)
    {
        $payment = payment::find($id);
        //dd($payment);
        $payment->update([
            'status' => $request->status,
        ]);
        return redirect()->route('admin_payment');
    }
    public function admin_userlist()
    {
        $users = User::where('role_id', 2)->get();
        return view('Backend.Layout.sellers', compact('users'));
    }
    public function admin_userlist_edit($id)
    {
        $user = User::find($id);
        return view('Backend.Layout.user_list_edit', compact('user'));
    }
    public function admin_userlist_update(Request $request, $id)
    {
        try {
            $user = User::find($id);
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
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $filename,
                'address' => $request->address,

            ]);
            if ($user->role_id == 2) {
                return redirect()->route('admin_userlist')->with('success', 'Update Successfully');
            } else {
                return redirect()->route('admin_customer')->with('success', 'Update Successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Field Value Required');
        }
    }
    public function admin_userlist_delete($id)
    {
        $user = User::find($id);
        $des = public_path('\\uploads\\Profile\\' . $user->image);
        //dd($des);
        if (File::exists($des)) {
            File::delete($des);
        }
        $user = User::find($id)->delete();

        return redirect()->route('admin_userlist')->with('error', 'Delete Successfully');
    }





    //customer Mail

    public function bider_mail_procced($id)
    {

        $product = product::find($id);
        //dd($product);
        $bids = Bid::orderBy('bid_a', 'desc')->get();

        foreach ($bids as $bid) {
            $today = Carbon::today();
            $to = Carbon::now();
            $finishTime = Carbon::parse($product->bid_end);
            $time = $product->bid_time;
            list($hours, $minutes) = explode(':', $time);
            $end = $finishTime->addHours($hours)->addMinutes($minutes);
            $max = Bid::where('item_id', $product->id)->max('bid_a');
            $Bidder = Bid::where('item_id', $product->id)->where('bid_a', $max)->first()->user;
            //dd($Bidder);

            if ($to > $end && $max == $bid->bid_a) {

                //dd($product,$max);
                return view("emails.winner_procced", compact('product', 'max', 'Bidder'));
            }
        }
    }
    public function contact($id)
    {
        $product = product::find($id);
        //dd($product);
        $bid = Bid::where('item_id', $product->id)->get();
        $to = Carbon::now();
        $finishTime = Carbon::parse($product->bid_end);
        $time = $product->bid_time;
        list($hours, $minutes) = explode(':', $time);
        $end = $finishTime->addHours($hours)->addMinutes($minutes);
        $max = Bid::where('item_id', $product->id)->max('bid_a');
        // dd($max);
        // dd($max == null);
        if ($max == null) {

            return redirect()->route('admin_bider_list')->with('error', 'No Mailer Found');
        } else {

            $Bidder = Bid::where('item_id', $product->id)->where('bid_a', $max)->first()->user;
            //  dd($Bidder,$max );
            if ($to > $end && $max) {

                //dd($product,$max);
                $order_info = [
                    'Bidder_name' => $Bidder->name,
                    'Bidder_email' => $Bidder->email,
                    'Product_name' => $product->name,
                    'Product_amount' => $max,

                ];
                //   $bid_id =Bid::where('item_id', $product->id)->get();
                Mail::to($Bidder->email)->send(new WinnierMail($order_info, $product->id));
                return redirect()->route('admin_bider_list')->with('success', 'Mail Send Successfully');
            } else {
                return redirect()->route('admin_bider_list')->with('error', 'Time Not Finished Yet');
            }
        }
    }
    public function bider_mail_payment($id, $p_id)
    {
        // dd($id,$p_id);
        $user = User::find($id);
        $product = product::find($p_id);
        $max = Bid::where('item_id', $product->id)->max('bid_a');

        //dd($user,$product);
        return view("emails.payment", compact('user', 'product', 'max'));
    }

    public function bider_payment(Request $request, $id, $u_id)
    {
        $product = product::where('id', $id)->first();
        $seller = $product->seller_id;
        payment::create([
            'name' => $request->name,
            'email' => $request->email,
            'transaction_number' => $request->transaction_number,
            'transaction_amount' => $request->transaction_amount,
            'date' => $request->date,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'phone_number' => $request->phone_number,
            'buyer_id' => $u_id,
            'product_id' => $id,
            'seller_id' => $seller,
            'status' => 2,
        ]);
        return redirect()->route('bider_pending');
    }
    public function bider_pending()
    {
        return view('emails.pending');
    }

    public function fatch_subcat($id){
        $subcats = sub_category::where('cate_id',$id)->get();
        
        return response()->json([
            'status' => 200,
            'subCats' => $subcats
        ]);
    }


    //download
    public function download($id)
    {
        $invoice = payment::findOrFail($id);
        $invoice1 = $invoice->status;
        $invoice3 = $invoice->product_id;
        $product = product::where('id',$invoice3)->first();
        
        if($invoice1 == 1) {
            $invoice1 = 'confirm';
            
            $data = [
                'name' => $product->name,
                'description' => $product->description,
                'invoiceName' => $invoice->name,
                'email' => $invoice->email,
                'transactionNumber' => $invoice->transaction_number,
                'transactionAmount' => $invoice->transaction_amount,
                'streetAddress' => $invoice->street_address,
                'city' => $invoice->city,
                'phoneNumber' => $invoice->phone_number,
                'status' => $invoice1
            ];
           //dd($data);
            
            $pdf = Pdf::loadView('Frontend.pdf.invoice', compact('data'));
            return $pdf->download('invoice.pdf');
        }
        elseif($invoice1 == 2){
            $invoice1 ='pending';
           return redirect()->back()->with('error', ' Payment On Pending Process, Please Wait Untill Confirm.');

        }
       

        
    }

    //search
    public function search(Request $request)
    {
        $query = $request->input('query');
      try
      {
        $products = Product::where('name', 'like', '%'.$query.'%')
        ->orWhereDate('bid_end', Carbon::parse($query)->format('Y-m-d'))
                ->orWhereTime('bid_time', Carbon::parse($query)->format('H:i:s'))->get();
      }
      catch (Exception $e) {
        $products = Product::where('name', 'like', '%'.$query.'%')->get();
      }
        // dd($query)
          
        return view('Backend.Layout.search_result', compact('products'));
    }
    

    public function search_result()
    {
       return view('Backend.Layout.search_result');
    }
}

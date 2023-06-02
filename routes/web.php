<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\SubCategoryController;
use App\Http\Controllers\CatgoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserInterface;
use App\Mail\WinnierMail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//User Interface

Route::get('/', [UserInterface::class, 'user_interface'])->name('user_interface');
Route::get('/details/{id}', [UserInterface::class, 'user_interface_details'])->name('user_interface_details');



//User Pannel

Route::get('/user/login', [FrontendController::class, 'user_login'])->name('user_login');
Route::post('/login1', [FrontendController::class, 'login1'])->name('login1');
Route::post('/registration', [FrontendController::class, 'registration'])->name('registration');
Route::get('/customer/registration', [FrontendController::class, 'customer_registration'])->name('customer_registration');

Route::middleware(['customer_check'])->group(function () {

Route::get('/customer/product_details/{id}', [FrontendController::class, 'customer_details'])->name('customer_details');
Route::get('/customer/payment/{id}', [FrontendController::class, 'customer_payment'])->name('customer_payment');
Route::get('/customer/dashboard', [FrontendController::class, 'customer_dashboard'])->name('customer_dashboard');
Route::get('/customer/profile/{id}', [FrontendController::class, 'customer_profile'])->name('customer_profile');
Route::post('/customer/bid/{p_id}/{id}', [FrontendController::class, 'customer_bid'])->name('customer_bid');
Route::get('/customer/biding/info/{id}', [FrontendController::class, 'customer_biding_info'])->name('customer_biding_info');
Route::get('/customer/update/info', [FrontendController::class, 'customer_update_info'])->name('customer_update_info');
Route::put('/customer/updated/info', [FrontendController::class, 'customer_updated_info'])->name('customer_updated_info');

Route::get('/download/{id}', [BackendController::class, 'download'])->name('download');

//click Time
Route::get('/get_time/{id}', [FrontendController::class, 'get_time'])->name('get_time');

});


//Seller Pannel

Route::get('/seller/login', [FrontendController::class, 'seller_login'])->name('seller_login');
Route::post('/login2', [FrontendController::class, 'login_S'])->name('login_S');
Route::get('/seller/registration', [FrontendController::class, 'seller_registration'])->name('seller_registration');
Route::post('/registration1', [FrontendController::class, 'registration_s'])->name('registration_s');

Route::middleware(['seller_check'])->group(function () {

        Route::get('/seller/profile/{id}', [FrontendController::class, 'seller_profile'])->name('seller_profile');
        Route::get('/seller/dashboard', [FrontendController::class, 'seller_dashboard'])->name('seller_dashboard');
        Route::get('/seller/customer', [FrontendController::class, 'seller_customer'])->name('seller_customer');
        Route::get('/seller/bider/list/{id}', [FrontendController::class, 'seller_bider_list'])->name('seller_bider_list');
        Route::get('/seller/payment/{id}', [FrontendController::class, 'seller_payment'])->name('seller_payment');
        
        
        //category
        Route::get('/seller/category/{id}', [FrontendController::class, 'seller_category'])->name('seller_category');
        Route::post('/seller/category/create', [FrontendController::class, 'seller_category_create'])->name('seller_category_create');
        Route::get('/seller/category/edit/{id}', [FrontendController::class, 'seller_category_edit'])->name('seller_category_edit');
        Route::put('/seller/category/update/{id}', [FrontendController::class, 'seller_category_update'])->name('seller_category_update');
        Route::get('/seller/category/delete/{id}', [FrontendController::class, 'seller_category_delete'])->name('seller_category_delete');
        
        //sub category
        Route::get('/seller/sub_category/{id}', [FrontendController::class, 'seller_sub_category'])->name('seller_sub_category');
        Route::post('/seller/sub_category/create', [FrontendController::class, 'seller_sub_category_create'])->name('seller_sub_category_create');
        Route::get('/seller/sub_category/edit/{id}', [FrontendController::class, 'seller_sub_category_edit'])->name('seller_sub_category_edit');
        Route::put('/seller/sub_category/update/{id}', [FrontendController::class, 'seller_sub_category_update'])->name('seller_sub_category_update');
        Route::get('/seller/sub_category/delete/{id}', [FrontendController::class, 'seller_sub_category_delete'])->name('seller_sub_category_delete');
        
        //product
        Route::get('/seller/product/{id}', [FrontendController::class, 'seller_product'])->name('seller_product');
        Route::post('/seller/product/create', [FrontendController::class, 'seller_product_create'])->name('seller_product_create');
        Route::get('/seller/product/edit/{id}', [FrontendController::class, 'seller_product_edit'])->name('seller_product_edit');
        Route::put('/seller/product/update/{id}', [FrontendController::class, 'seller_product_update'])->name('seller_product_update');
        Route::get('/seller/product/delete/{id}', [FrontendController::class, 'seller_product_delete'])->name('seller_product_delete');
   
});



//admin login
Route::get('/admin/login', [BackendController::class, 'admin_login'])->name('admin_login');
Route::post('/login0', [BackendController::class, 'login0'])->name('login0');
Route::get('/signout', [BackendController::class, 'signout'])->name('signout');

Route::middleware(['admin_check'])->group(function () {

        //Search
        Route::get('/search', [BackendController::class, 'search'])->name('search');
        Route::get('/search/result', [BackendController::class, 'search_result'])->name('search_result');

        //mail contact
        Route::get('/bider/contact/{id}', [BackendController::class, 'contact'])->name('contact');


        //dashboard
        Route::get('/admin/dashboard', [BackendController::class, 'admin_dashboard'])->name('admin_dashboard');
        Route::get('/admin/bider/list', [BackendController::class, 'admin_bider_list'])->name('admin_bider_list');
        Route::get('/admin/customer', [BackendController::class, 'admin_customer'])->name('admin_customer');
        Route::get('/admin/customer/delete/{id}', [BackendController::class, 'admin_customerlist_delete'])->name('admin_customerlist_delete');

        Route::get('/admin/payment', [BackendController::class, 'admin_payment'])->name('admin_payment');
        Route::post('/admin/payment/status/{id}', [BackendController::class, 'admin_payment_status'])->name('admin_payment_status');
        Route::get('/admin/userlist', [BackendController::class, 'admin_userlist'])->name('admin_userlist');
        Route::get('/admin/userlist/edit/{id}', [BackendController::class, 'admin_userlist_edit'])->name('admin_userlist_edit');
        Route::put('/admin/userlist/update/{id}', [BackendController::class, 'admin_userlist_update'])->name('admin_userlist_update');
        Route::get('/admin/userlist/delete/{id}', [BackendController::class, 'admin_userlist_delete'])->name('admin_userlist_delete');


        //product Route
        Route::get('/admin/product', [ProductController::class, 'admin_product'])->name('admin_product');
        Route::post('/admin/product/add', [ProductController::class, 'admin_product_add'])->name('admin_product_add');
        Route::get('/admin/product/edit/{id}', [ProductController::class, 'admin_product_edit'])->name('admin_product_edit');
        Route::put('/admin/product/update/{id}', [ProductController::class, 'admin_product_update'])->name('admin_product_update');
        Route::get('/admin/product/delete/{id}', [ProductController::class, 'admin_product_delete'])->name('admin_product_delete');


    
        //Catgory Route
        Route::get('/admin/category/list', [CategoryController::class, 'admin_category_list'])->name('admin_category_list');
        Route::post('/admin/category/add', [CategoryController::class, 'admin_category_add'])->name('admin_category_add');
        Route::get('/admin/category/edit/{id}', [CategoryController::class, 'admin_category_edit'])->name('admin_category_edit');
        Route::put('/admin/category/update/{id}', [CategoryController::class, 'admin_category_update'])->name('admin_category_update');
        Route::get('/admin/category/delete/{id}', [CategoryController::class, 'admin_category_delete'])->name('admin_category_delete');
      
        //Sub_Catgory Route
        Route::get('/admin/sub_category/list', [SubCategoryController::class, 'admin_sub_category_list'])->name('admin_sub_category_list');
        Route::post('/admin/sub_category/add', [SubCategoryController::class, 'admin_sub_category_add'])->name('admin_sub_category_add');
        Route::get('/admin/sub_category/edit/{id}', [SubCategoryController::class, 'admin_sub_category_edit'])->name('admin_sub_category_edit');
        Route::put('/admin/sub_category/update/{id}', [SubCategoryController::class, 'admin_sub_category_update'])->name('admin_sub_category_update');
        Route::get('/admin/sub_category/delete/{id}', [SubCategoryController::class, 'admin_sub_category_delete'])->name('admin_sub_category_delete');

    
        
        
});


//mail
Route::get('/customer/mail/procced/{id}', [BackendController::class, 'bider_mail_procced'])->name('bider_mail_procced');
Route::get('/customer/payment/{id}/{p_id}', [BackendController::class, 'bider_mail_payment'])->name('bider_mail_payment');
Route::post('/customer/payment/{id}/{u_id}', [BackendController::class, 'bider_payment'])->name('bider_payment');
Route::get('/customer/pending', [BackendController::class, 'bider_pending'])->name('bider_pending');

//Auto Sub Category select -> without authtication 
Route::get('/fatch_subcat/{id}', [BackendController::class, 'fatch_subcat'])->name('fatch_subcat');















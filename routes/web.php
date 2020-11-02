<?php

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

// Route::get('/home', function () {
//     return view('welcome');
// });

Auth::routes();
//Middleware
    Route::get('/', 'Product\ProductController@homeslidertry')->name('home');

    Route::get('/search', 'Product\ProductController@search_product')->name('search.product');
    Route::get('/Product-All', 'Product\ProductController@productall')->name('Product.All');
    Route::get('/Product-All/pagination/fetch_data', 'Product\ProductController@fetch_data');

    Route::get('/Product-All-Woman', 'Product\ProductController@productallwomen')->name('Product.Women');
    Route::get('/Product-All-Child', 'Product\ProductController@productallchild')->name('Product.Child');
    Route::get('/Product-All-Man', 'Product\ProductController@productallmale')->name('Product.Man');
    Route::get('/Product-All-Universal', 'Product\ProductController@productalluniv')->name('Product.Universal');
    Route::get('/Product-Detail/{id_product}', 'Product\ProductController@detailproduct')->name('Product.Detail');

    Route::get('/Try-Something-New','Product\TryNewProductController@trysomethingnew');
    Route::get('/TrySomethingNew/Liontin', 'Product\TryNewProductController@Liontinproduct')->name('Try.Liontin');
    Route::get('/TrySomethingNew/Ring', 'Product\TryNewProductController@Ringproduct')->name('Try.Ring');

    Route::get('/Customize-Product','Product\CustomizeProductController@customizeproductview')->name('Customize.view');
    Route::post('/Customize-Product/Save','Product\CustomizeProductController@customizeproductsave')->name('Customize.save');

    Route::get('/Special-Product','Product\SpecialProductController@index')->name('Special.Product');
    Route::get('/Special-Product/GIA','Product\SpecialProductController@spesialproductgia')->name('Special.GIA');
    Route::get('/Special-Product/Logam-Mulia','Product\SpecialProductController@spesialproductlm')->name('Special.LM');

    Route::get('/Product-Bundle', 'Product\BundleProductController@Bundleproduct')->name('Bundle');
    Route::get('/Product-Bundle/Slider', 'Product\BundleProductController@bundleslidertry')->name('Bundle.slider');

    Route::get('/Wishlist','Wishlist\WishlistController@show')->name('wishlist');
    Route::get('/wishlist/{id_product}','Wishlist\WishlistController@add');
    Route::get('/wishlist-delete/{id_item}','Wishlist\WishlistController@delete');

    Route::get('/register','Security\RegisterController@register');
    Route::post('/register-user','Security\RegisterController@registeruser')->name('register.user');

    Route::get('/login','Security\LoginController@login')->name('login');
    Route::post('/login','Security\LoginController@postLogin');
    Route::post('/logout','Security\LoginController@logout');
    Route::get('/forgot_password','Security\LoginController@forgot');
    Route::post('/forgot_password','Security\LoginController@forgotpassword');
    Route::get('/reset-password/{email}/{code}','Security\LoginController@reset');
    Route::post('/reset-password/{email}/{code}','Security\LoginController@reset_password');

    Route::get('/Profile-User','Profile\ProfileController@profileuser');
    Route::get('/Profile-Update/{id}','Profile\ProfileController@profileupdate')->name('profile.update');
    Route::post('/Profile-Update/Data/{id}','Profile\ProfileController@updatedata')->name('profile.updatedata');

    Route::get('/Cart','Cart\CartController@cartview')->name('cart.view');
    Route::post('/Add-to-Cart','Cart\CartController@addcart')->name('cart.add');
    Route::post('/Voucher-Remove','Cart\CartController@removevoucher')->name('voucher.remove');
    Route::post('/Cart-Remove', 'Cart\CartController@remove')->name('cart.remove');
    // Route::get('/Cart-Voucher/Apply', 'Cart\CartController@applyvoucher')->name('cart.voucher');
    Route::get('/Cart-Voucher/Apply', 'Cart\CartController@applyvoucher')->name('cart.voucher');
    Route::post('/Cart-Update','Cart\CartController@updateqtycart')->name('cart.update');
    // Route::post('/Cart/Minus','Cart\CartController@minusqtycart')->name('cart.minus');


    Route::get('/Checkout','Checkout\CheckoutController@checkoutview')->name('checkout.view');
    Route::get('/Order-History','Checkout\CheckoutController@orderhistory')->name('order.history');
    Route::get('/Cart-Checkout', 'Checkout\CheckoutController@checkout')->name('cart.checkout');

    // Route::get('/Payment-Transaction/{id}','Checkout\CheckoutController@espaypayment')->name('payment');
    Route::get('/Payment-Transaction/Done','Checkout\CheckoutController@paymentdone')->name('payment.done');

    Route::post('/Checkout-Payment','Checkout\CheckoutController@store')->name('checkout.payment');

    //ESPAY PAYMENT
    Route::get('/Payment-Inquiry','Inquiry\Inquiry@paymentinquiry')->name('inq.espay');
    Route::get('/Payment-Espay','Inquiry\Inquiry@inquiryespay');


Route::get('/Faq','HomeController@faq');
Route::get('/How-To-Use','HomeController@howuse');
Route::get('/Syarat-Ketentuan','HomeController@syaratketentuan');
Route::get('/Kebijakan-Privasi','HomeController@kebijakanprivasi');
Route::get('/province/{id}/cities', 'Checkout\CheckoutController@getCities');
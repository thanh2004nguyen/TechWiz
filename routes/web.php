<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// chat box
use App\Http\Controllers\Chat\AdminChatController;
use App\Http\Controllers\Chat\CreateController;
use App\Http\Controllers\Chat\GetChatsController;
use App\Http\Controllers\Chat\GetMessagesController;
use App\Http\Controllers\Chat\PostMessageController;

// end chat box
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\VoucherController;

use App\Http\Controllers\StaticticalController;
use App\Http\Controllers\ReviewController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/', [HomeController::class, 'index']);
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
//     // ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



//realtime chat box
Route::prefix('chattle')->group(function () {
    Route::view('chat', 'chat.chat');
    Route::post('create-chat', CreateController::class);
    Route::post('post-message', PostMessageController::class);
    Route::get('get-messages', GetMessagesController::class);
    Route::get('chat-admin', AdminChatController::class);
    Route::get('get-chats', GetChatsController::class);
});
// end chat box



//coupon(H)
Route::post('/check-coupon', [VoucherController::class, 'check_coupon']);
Route::get('/unset-coupon', [VoucherController::class, 'unset_coupon']);
Route::get('/insert_coupon', [VoucherController::class, 'insert_coupon']);
Route::get('/delete-coupon/{coupon_id}', [VoucherController::class, 'delete_coupon'])->name('coupon.delete');
Route::get('/list_coupon', [VoucherController::class, 'list_coupon']);
Route::post('/insert-coupon-code', [VoucherController::class, 'insert_coupon_code']);
Route::get('/editcoupon/{coupon_id}', [VoucherController::class, 'edit_coupon'])->name('coupon.edit');
Route::get('/posteditcoupon', [VoucherController::class, 'postedit_coupon'])->name('coupon.postedit');
//end coupon

// quan ly cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/cart/add', [CartController::class, 'addProduct'])->name('cart.add');
Route::post('/cart/update/{product_id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/delete/{product}', [CartController::class, 'deleteItem'])->name('cart.delete');
Route::get('/cart/update', [CartController::class, 'emptyCart'])->name('cart.empty');


//order

Route::get('/manage_order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{code}', [OrderController::class, 'admin_view_order']);
Route::post('/update-qty', [AdminController::class, 'update_qty']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'order_code']);
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);

 
//Delivery
Route::get('/delivery', [AdminController::class, 'delivery']);
Route::post('/select-delivery', [AdminController::class, 'select_delivery']);
Route::post('/insert-delivery', [AdminController::class, 'insert_delivery']);
Route::post('/select-feeship', [AdminController::class, 'select_feeship']);
Route::post('/update-delivery', [AdminController::class, 'update_delivery']);


// Cong Thanh Toan
// COD
Route::post('/checkout/confirm', [CheckoutController::class, 'confirm_order'])->name('checkout.confirm_order');
// VNPAY
Route::post('/vnpay_payment', [CheckoutController::class, 'vnpay_payment']);
Route::get('/checkout/vnPayCheck', [CheckoutController::class, 'vnPayCheck']);
// Paypal
Route::post('/paypal_payment', [CheckoutController::class, 'paypal_payment']);



// order controller

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/{order_id}', [OrderController::class, 'cancel_order'])->name('order.cancel');
Route::get('/vieworder/{order_id}', [OrderController::class, 'view_order'])->name('order.view');
Route::get('/print-order/{order_id}', [OrderController::class, 'print_order'])->name('order.print');

Route::get('sendMail',[CheckoutController::class, 'sendMail']);

Route::get('/check-order-status', [OrderController::class, 'checkOrderStatus'])->name('checkOrderStatus');
Route::get('/admincheck-order-status', [OrderController::class, 'admincheckOrderStatus'])->name('admincheckOrderStatus');
// voucher
Route::get('/check-voucher', [VoucherController::class,'checkVoucher'])->name('check.voucher');
// Route::resource('voucher',VoucherController::class);


// báo cáo(H)
Route::get('/statstical', [StaticticalController::class, 'statistical'])->name('statistical.index');
Route::post('/filter-by-date', [StaticticalController::class, 'filterbydate'])->name('statistical.filter-by-date');
Route::post('/dashboard-filler', [StaticticalController::class, 'dashboardfiller'])->name('statistical.dashboardfiller');
Route::post('/day-order', [StaticticalController::class, 'day_order']);

// báo cáo product(H)
Route::get('/pstatstical', [StaticticalController::class, 'pstatistical'])->name('statistical.pindex');
Route::post('/pfilter-by-date', [StaticticalController::class, 'pfilterbydate'])->name('statistical.pfilter-by-date');
Route::post('/pdashboard-filler', [StaticticalController::class, 'pdashboardfiller'])->name('statistical.pdashboardfiller');
Route::post('/pday-order', [StaticticalController::class, 'pday_order']);


  // review
Route::get('/list-review', [ReviewController::class, 'listReview'])->name('listReview');

Route::get('/review/{product_id}', [CheckoutController::class,'review'])->name('review');
Route::post('/submit-review', [CheckoutController::class,'savereview'])->name('submit-review');
Route::post('/admin/reply-comment/{reviewId}', [ReviewController::class, 'replyComment'])->name('admin.replyComment');
Route::delete('/admin/deleteComment/{id}', [ReviewController::class, 'deleteComment'])->name('admin.deleteComment');
Route::get('/dashboard', [AdminController::class, 'dasboard']);

//  product detail
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');







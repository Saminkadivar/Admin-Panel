<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MailControler;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('product', ProductController::class);
Route::delete("/product/delete/{id?}",[ProductController::class,"destroy"])->name('product.delete');

Route::view('dashboard', 'admin.dashboard');
        Route::get('dashboard', [AdminAuthController::class, "dashboard"])->name('admin1.dashboard');


Route::resource('user', UserController::class);
Route::delete("/user/delete/{id?}",[UserController::class,"destroy"])->name('user.delete');

Route::view('orders', 'product.ordin')->name('product.ordin');
// Route::get('order', [OrderController::class, "index"])->name('product.order');
// Route::get('order/{order}', [OrderController::class, 'show'])->name('product.ordshow');
//     Route::get('/order/data', [OrderController::class, 'getOrders'])->name('product.ordin.data');
Route::get('/orders', [OrderController::class, 'index'])->name('product.ordin');
Route::get('/orders/data', [OrderController::class, 'getOrders'])->name('product.ordin.data');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('product.ordshow');
    // Route::get('/product/ordin', [OrderController::class, 'index'])->name('product.ordin');


    // Route::prefix('order')->middleware(['auth'])->group(function () {
    // Route::get('/product/ordin', [OrderController::class, 'index'])->name('product.ordin');
    // Route::get('/product/ordin/{order}', [OrderController::class, 'show'])->name('product.show');
// });


Route::resource('comments', CommentController::class);
Route::delete("/comments/delete/{id?}",[CommentController::class,"destroy"])->name('comments.delete');



Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');

    // })->middleware('auth:admin')->name('admin.dashboard');
});


// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

//     Route::middleware('auth:admin')->group(function () {
//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');

//         Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

//         // Add other protected admin routes here
//              Route::get('dashboard', [AdminAuthController::class, "dashboard"])->name('admin1.dashboard');

//     });
// });


//              Route::get('dashboard', [AdminAuthController::class, "dashboard"])->name('admin1.dashboard');
// Route::get('/send-mail', function () {
//     $user = (object)[ 'name' => 'John Doe', 'email' => 'john@example.com' ];
//     Mail::to($user->email)->send(new App\Mail\WelcomeMail($user));
//     return 'Email sent successfully!';
// });



Route::get('/send-mail', function () {
    $data = ['message' => 'This is a test message from Laravel 12 mail system.'];

    Mail::to('saminkadivar1@gmail.com')->send(new TestMail($data));

    return 'Mail sent!';
})->name('email.send');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/send-otp', [AdminAuthController::class, 'sendOtp'])->name('admin.send.otp');
    Route::get('/otp', [AdminAuthController::class, 'showOtpForm'])->name('admin.otp.form');
    Route::post('/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.verify.otp');
    // Route::post('/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');
    
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
// web.php
// Route::post('/admin/send-otp', [AdminAuthController::class, 'sendOtp'])->name('admin.send.otp');
// Route::post('/admin/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.verify.otp');
// Route::post('/admin/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');
Route::post('/admin/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');


// Route::middleware(['auth:admin'])->group(function () {
    
// });
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/profile', [AdminAuthController::class, 'editProfile'])->name('admin.profile');
       Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
       Route::post('change-password', [AdminAuthController::class, 'changePassword'])->name('admin.change.password');
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin1.dashboard');
});

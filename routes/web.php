<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Mail\TestMail;

// // ==============================
// // General Routes
// // ==============================

// Route::get('/send-mail', function () {
//     $data = ['message' => 'This is a test message from Laravel 12 mail system.'];
//     Mail::to('saminkadivar1@gmail.com')->send(new TestMail($data));
//     return 'Mail sent!';
// })->name('email.send');

// // ==============================
// // Product Routes
// // ==============================

// Route::resource('product', ProductController::class);
// Route::delete("/product/delete/{id?}",[ProductController::class,"destroy"])->name('product.delete');


// // ==============================
// // User Routes
// // ==============================

// Route::resource('user', UserController::class);
// Route::delete("/user/delete/{id?}",[UserController::class,"destroy"])->name('user.delete');

// // ==============================
// // Order Routes
// // ==============================

// Route::get('/orders', [OrderController::class, 'index'])->name('product.ordin');
// Route::get('/orders/data', [OrderController::class, 'getOrders'])->name('product.ordin.data');
// Route::get('/orders/{order}', [OrderController::class, 'show'])->name('product.ordshow');

// // ==============================
// // Comment Routes
// // ==============================

// Route::resource('comments', CommentController::class);
// Route::delete('/comments/delete/{id?}', [CommentController::class, 'destroy'])->name('comments.delete');

// // ==============================
// // Admin Auth Routes (No Auth Required)
// // ==============================

// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

//     Route::post('/send-otp', [AdminAuthController::class, 'sendOtp'])->name('admin.send.otp');
//     Route::get('/otp', [AdminAuthController::class, 'showOtpForm'])->name('admin.otp.form');
//     Route::post('/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.verify.otp');
//     Route::post('/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');

//     Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
// });

// // ==============================
// // Admin Routes (Requires Auth)
// // ==============================

// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin1.dashboard');

//     Route::get('/profile', [AdminAuthController::class, 'editProfile'])->name('admin.profile');
//     Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
//     Route::post('/change-password', [AdminAuthController::class, 'changePassword'])->name('admin.change.password');
// });

// Admin Auth (Login, OTP, Logout) – No auth required

// // ==============================
// // Test Mail Route (Optional)
// // ==============================
// Route::get('/send-mail', function () {
//     $data = ['message' => 'This is a test message from Laravel 12 mail system.'];
//     Mail::to('saminkadivar1@gmail.com')->send(new TestMail($data));
//     return 'Mail sent!';
// })->name('email.send');


    // // ==============================
    // // Admin Auth Routes (No Login Required)
    // // ==============================
    // Route::prefix('admin')->middleware('auth:admin')->group(function () {
    //     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    //     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    //     Route::get('/otp', [AdminAuthController::class, 'showOtpForm'])->name('admin.otp.form');
    //     Route::post('/send-otp', [AdminAuthController::class, 'sendOtp'])->name('admin.send.otp');
    //     Route::post('/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.verify.otp');
    //     Route::post('/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');
    // });

    // // ==============================
    // // Admin Routes (Authenticated Only)
    // // ==============================
    // Route::prefix('admin')->middleware('auth:admin')->group(function () {

    //     // 🟢 Dashboard
    //     Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin1.dashboard');

    //     // 🟢 Admin Profile Settings
    //     Route::get('/profile', [AdminAuthController::class, 'editProfile'])->name('admin.profile');
    //     Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    //     Route::post('/change-password', [AdminAuthController::class, 'changePassword'])->name('admin.change.password');

    //     // 🟢 Admin Logout
    //     Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    //     // 🟢 Product Routes
    //     Route::resource('product', ProductController::class);
    //     Route::delete('product/delete/{id?}', [ProductController::class, 'destroy'])->name('product.delete');

    //     // 🟢 User Routes
    //     Route::resource('user', UserController::class);
    //     Route::delete('user/delete/{id?}', [UserController::class, 'destroy'])->name('user.delete');

    //     // 🟢 Order Routes
    //     Route::get('/orders', [OrderController::class, 'index'])->name('product.ordin');
    //     Route::get('/orders/data', [OrderController::class, 'getOrders'])->name('product.ordin.data');
    //     Route::get('/orders/{order}', [OrderController::class, 'show'])->name('product.ordshow');

    //     // 🟢 Comment Routes
    //     Route::resource('comments', CommentController::class);
    //     Route::delete('/comments/delete/{id?}', [CommentController::class, 'destroy'])->name('comments.delete');
    // });

    // // ==============================
    // // Default Route (Redirect to Login)
    // // ==============================
    // Route::get('/', function () {
    //     return redirect()->route('admin.login');
    // });

// Admin Login + OTP Routes

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::get('/otp', [AdminAuthController::class, 'showOtpForm'])->name('admin.otp.form');
    Route::post('/send-otp', [AdminAuthController::class, 'sendOtp'])->name('admin.send.otp');
    Route::post('/verify-otp', [AdminAuthController::class, 'verifyOtp'])->name('admin.verify.otp');
    Route::post('/resend-otp', [AdminAuthController::class, 'resendOtp'])->name('admin.resend.otp');
});

// Admin Protected Routes (Login Required)
Route::prefix('')->middleware('auth:admin')->group(function () {

    // 🔹 Dashboard
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin1.dashboard');

    // 🔹 Admin Profile
    Route::get('/profile', [AdminAuthController::class, 'editProfile'])->name('admin.profile');
    Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/change-password', [AdminAuthController::class, 'changePassword'])->name('admin.change.password');

    // 🔹 Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // 🔹 Products
    Route::resource('product', ProductController::class);
    Route::delete('product/delete/{id?}', [ProductController::class, 'destroy'])->name('product.delete');

    // 🔹 Users
    Route::resource('user', UserController::class);
    Route::delete('user/delete/{id?}', [UserController::class, 'destroy'])->name('user.delete');

    // 🔹 Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('product.ordin');
    Route::get('/orders/data', [OrderController::class, 'getOrders'])->name('product.ordin.data');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('product.ordshow');

    // 🔹 Comments
    Route::resource('comments', CommentController::class);
    Route::delete('/comments/delete/{id?}', [CommentController::class, 'destroy'])->name('comments.delete');
});

// Root Redirect to Admin Login

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');
use App\Http\Controllers\AdminNotificationController;

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');
    Route::post('/admin/notifications/read/{id}', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/admin/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.markAllRead');
});

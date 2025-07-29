<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\AdminOtpMail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminAuthController extends Controller
{

    public function dashboard( )
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalorder = Order::count();
        $totalcomment = Comment::count();
        $totalrevenue= Order::sum('total');
        $totalUsers = User::count();
    $totalProducts = Product::count();
    $totalorder = Order::count();
    $totalrevenue = Order::sum('total');

    // 🟢 Orders by status
    $ordersByStatus = Order::select('status', Order::raw('count(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

    // 🟢 Revenue by month (last 6 months)
    $monthlyRevenue = Order::select(
        Order::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
        order::raw('SUM(total) as total')
    )
    ->groupBy('month')
    ->orderBy('month', 'asc')
    ->take(6)
    ->pluck('total', 'month')
    ->toArray();

    return view('admin.dashboard', compact(
        'totalUsers',
        'totalProducts',
        'totalorder',
        'totalcomment',
        'totalrevenue',
        'ordersByStatus',
        'monthlyRevenue'
    ));
        // return view('product.dashboard', compact('totalUsers', 'totalProducts','totalorder','totalrevenue'));
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }


public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin1.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }



   public function sendOtp(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!Auth::guard('admin')->validate($credentials)) {
        return back()->withErrors(['Invalid credentials.']);
    }

    $otp = rand(100000, 999999);
    session(['otp' => $otp, 'email' => $request->email]);

    // Send OTP mail
    Mail::to($request->email)->send(new AdminOtpMail($otp));

    return back()->with('otp_sent', true);
}

public function verifyOtp(Request $request)
{
    $enteredOtp = $request->input('otp');
    $sessionOtp = session('otp');
    $email = session('email');

    if ($enteredOtp == $sessionOtp) {
        // Log the admin in
        $admin = \App\Models\Admin::where('email', $email)->first();
        Auth::guard('admin')->login($admin);

        session()->forget(['otp', 'email']);

        return redirect()->route('admin1.dashboard');
    }

    return back()->withErrors(['OTP is incorrect.'])->with('otp_sent', true);
}


    public function showOtpForm()
    {
        return view('admin.otp-form'); 
    }
public function resendOtp(Request $request)
{
    $request->validate(['email' => 'required|email']);

    // Optionally: Check if email is valid admin
    $otp = rand(100000, 999999);
    AdminOtp::create(['email' => $request->email, 'otp' => $otp]);

    Mail::to($request->email)->send(new AdminOtpMail($otp));

    return back()->with('erroe', 'OTP resent to your email.');
}

//    public function editProfile()
// {
//     return view('admin.profile', ['admin' => auth()->user()]);
// }

public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'current_password' => 'nullable|required_with:new_password|string',
        'new_password' => 'nullable|string|min:6|confirmed',
    ]);

    $admin->name = $request->name;

    // Profile Picture Upload
  if ($request->hasFile('profile_picture')) {
    $file = $request->file('profile_picture');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->storeAs('profile_pictures', $filename, 'public'); // Corrected path
    $admin->profile_picture = $filename;
}


    // Change Password
    if ($request->filled('new_password')) {
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
        $admin->password = Hash::make($request->new_password);
    }

    $admin->save();

    return back()->with('success', 'Profile updated successfully.');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:3|confirmed',
    ]);

    $admin = auth()->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect']);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return back()->with('success', 'Password changed successfully.');
}
}



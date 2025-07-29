<?php

namespace App\Http\Controllers;
  use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
class MailControler extends Controller
{
  

public function register(Request $request)
{
    $user = User::create([]);

    Mail::to($user->email)->send(new TestMail($user));

    return back()->with('success', 'Registration successful, email sent!');
}

}

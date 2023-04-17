<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.login.index');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->route('admin.gallery');
        }

        return redirect()
                    ->route('admin.login')
                    ->with('status', 'The username or password you entered is incorrect.');
    }
}

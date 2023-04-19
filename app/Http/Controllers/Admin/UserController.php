<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.login.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
 
            return redirect()->route('admin.galleries');
        }

        return redirect()
                    ->route('admin.login')
                    ->with('status', 'The username or password you entered is incorrect.');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'old_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(6)],
            'password_confirmation' => 'required',
        ]);
        
        User::find(auth()->user()->id)
            ->update(['password' => Hash::make($validated['password'])]);

        return redirect()->route('admin.profile')->with('status', 'Prifile updated.');
    }
}

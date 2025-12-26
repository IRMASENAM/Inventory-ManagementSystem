<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPassController extends Controller
{
    // Tampilkan form reset password
    public function showResetForm()
    {
        return view('auth.resetpass'); // ✅ sesuai dengan nama file
    }

    // Proses reset password
    public function reset(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
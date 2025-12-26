<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function profile()
    {
        return view('profile');
    }

    // Update profil
    public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'no_telepon' => 'nullable|string|max:20',
        'jabatan'    => 'nullable|string|max:100',
        'divisi'     => 'nullable|string|max:100',
        'alamat'     => 'nullable|string|max:255',
        'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name       = $request->name;
    $user->email      = $request->email;
    $user->no_telepon = $request->no_telepon;
    $user->jabatan    = $request->jabatan;
    $user->divisi     = $request->divisi;
    $user->alamat     = $request->alamat;

    // 🔹 Upload foto langsung ke public/storage/foto-profil
    if ($request->hasFile('foto')) {
        // hapus foto lama
        if ($user->foto && file_exists(public_path('storage/'.$user->foto))) {
            unlink(public_path('storage/'.$user->foto));
        }

        $filename = time().'_'.$request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('storage/foto-profil'), $filename);
        $user->foto = 'foto-profil/'.$filename;
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
}}
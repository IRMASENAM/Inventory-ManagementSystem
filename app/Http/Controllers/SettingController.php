<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // cari setting user, kalau belum ada buat default
        $setting = Setting::firstOrCreate(
            ['user_id' => $user->id],
            [
                'theme'     => 'light',
                'language'  => 'id',
                'notif'     => true,
                'dashboard' => 'statistik',
            ]
        );

        return view('settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'theme'     => 'required|in:light,dark',
            'language'  => 'required|in:id,en',
            'dashboard' => 'required|in:statistik,laporan,barang',
        ]);

        $setting = Setting::where('user_id', $user->id)->firstOrFail();

        $setting->update([
            'theme'     => $request->theme,
            'language'  => $request->language,
            'notif'     => $request->notif == 1, // checkbox / select
            'dashboard' => $request->dashboard,
        ]);

        return redirect()->route('settings')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
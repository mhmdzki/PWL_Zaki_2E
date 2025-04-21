<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Menambahkan data breadcrumb
        $breadcrumb = (object)[
            'title' => 'Profile',
            'list' => [
                'Home' => url('/'),
                'Profile' => url('profile.index')
            ]
        ];

        return view('profile.index', [
            'activeMenu' => 'profile',
            'user' => $user,
            'breadcrumb' => $breadcrumb 
        ]);
    }

    public function update_photo(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $user->nama = $request->input('nama');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/foto', $filename);

            if ($user->foto_profil && Storage::exists('public/foto/'.$user->foto_profil)) {
                Storage::delete('public/foto/'.$user->foto_profil);
            }

            $user->foto_profil = $filename;
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui',
            'foto_url' => $user->foto_profil ? asset('storage/foto/'.$user->foto_profil) : null,
            'nama' => $user->nama
        ]);
    }
}

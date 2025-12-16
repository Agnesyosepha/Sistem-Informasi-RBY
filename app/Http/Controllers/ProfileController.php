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
        return view('profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            // hapus foto lama
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // simpan foto baru
            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
    }
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {

            // hapus foto lama
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // simpan foto baru
            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Show profile
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    // Show edit form
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update profile info
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->lastname = $request->lastname;

        if ($request->hasFile('profile_photo')) {
            // delete old photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/' . $user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        // 🔥 Redirect to dashboard
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    // Delete profile
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Profile deleted successfully!');
    }
}

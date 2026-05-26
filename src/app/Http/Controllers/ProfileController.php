<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::first() ?? new Profile;

        return view('profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'tagline'          => 'nullable|string|max:255',
            'bio'              => 'nullable|string',
            'email'            => 'nullable|email|max:255',
            'github'           => 'nullable|url|max:255',
            'linkedin'         => 'nullable|url|max:255',
            'skills'           => 'nullable|array',
            'years_experience' => 'nullable|integer|min:0',
            'total_projects'   => 'nullable|integer|min:0',
            'availability'     => 'nullable|string|max:100',
        ]);

        Profile::updateOrCreate(['id' => 1], $validated);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }
}

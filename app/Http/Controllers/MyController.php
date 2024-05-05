<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data;


class MyController extends Controller
{
    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:data',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'birthdate' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'userImage' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Handle file upload if userImage is provided
        if ($request->hasFile('userImage')) {
            $imagePath = $request->file('userImage')->store('user_images');
            $validatedData['user_image'] = $imagePath;
        }

        // Create a new user with the validated data
        $user = data::create($validatedData);

        // If the user was successfully created, redirect with success message
        return redirect()->back()->with('success', 'User registered successfully!');
    }
}

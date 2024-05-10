<?php

namespace App\Http\Controllers;

use App\Mail\NewRegisteration;
use Illuminate\Http\Request;
use App\Models\data;
use RealRashid\SweetAlert\Facades\Alert;

class MyController extends Controller
{
    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255', // Adjust validation rule
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'birthdate' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'userImage' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        // Handle file upload if userImage is provided
        if ($request->hasFile('userImage')) {
            $image = $request->file('userImage');
            $imageName = $image->getClientOriginalName(); // Get the original file name with extension

            // Store the image name in the validated data
            $validatedData['user_image'] = $imageName;

            // Save the image to the storage directory
            $image->storeAs('user_images', $imageName);
        }
        // Check if the username is unique
        $isUnique = data::where('user_name', $validatedData['user_name'])->doesntExist();
        if (!$isUnique) {
            Alert::error(__('strings.HeaderMessageTakenUser'),__('strings.BodyMessageTakenUser'));
            return redirect()->back()->withErrors(['user_name' => __('strings.TakenUserName')])->withInput();
        }

        // Create a new user with the validated data
        $user = data::create($validatedData);
        Alert::success(__('strings.HeaderSuccessMessage'),__('strings.WelcomeMessage'));
        $user->save();
        // Send an email to the user
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new NewRegisteration($user));
        // If the user was successfully created, redirect with success message
        return redirect()->back()->with('success', __('strings.SuccessMessage'));

    }
}
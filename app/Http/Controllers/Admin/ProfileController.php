<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show admin profile settings.
     */
    public function index()
    {
        $admin = auth()->user();

        return view('admin.profile.index', compact('admin'));
    }


    /**
     * Update admin profile.
     */
    public function update(Request $request)
    {
        $admin = auth()->user();

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;


        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_photo')) {

            if (
                $admin->profile_photo &&
                Storage::disk('public')->exists($admin->profile_photo)
            ) {
                Storage::disk('public')->delete(
                    $admin->profile_photo
                );
            }


            $admin->profile_photo =
                $request->file('profile_photo')
                    ->store('admin-profiles', 'public');
        }


        $admin->save();


        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }


    /**
     * Change admin password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $admin = auth()->user();

        $admin->password = $request->new_password;

        $admin->save();


        return back()->with(
            'success',
            'Password changed successfully.'
        );
    }
}

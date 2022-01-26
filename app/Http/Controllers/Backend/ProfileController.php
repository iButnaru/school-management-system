<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function viewProfile()
    {
        $user = Auth::user();
        return view('backend.user.user_profile', compact('user'));
    }

    public function editProfile(User $user)
    {
        return view('backend.user.edit_profile', compact('user'));
    }

    public function updateProfile(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->user_type = $request->user_type;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->status = $request->status;
        $old_photo = $request->old_photo;
        if ($request->file('profile_photo_path')) {
            $new_photo = $request->file('profile_photo_path')->store('profile-photos', 'public');
            unlink('storage/' .  $old_photo);
            $user->profile_photo_path =  $new_photo;
        };
        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        );

        $user->update();
        return redirect()->route('profile.view')->with($notification);
    }

    public function viewPassword()
    {
        return view('backend.user.edit_password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $currentPassword  = Auth::user()->password;
        if (Hash::check($request->password, $currentPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return back()->with('message', 'Current password is incorrect');
        }
    }
}

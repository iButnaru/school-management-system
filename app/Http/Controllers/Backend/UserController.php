<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewUsers()
    {
        // $users = User::all();
        $data['allData'] = User::all();
        return view('backend.user.view_user',  $data);
    }

    public function getAddUser()
    {
        return view('backend.user.add_user');
    }

    public function storeUser(Request $request)
    {
        $dataValidate = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required',
        ]);

        $user = new User([
            'name' => $request->name,
            'user_type' => $request->user_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $notification = array(
            'message' => 'User inserted successfully',
            'alert-type' => 'success'
        );

        $user->save();
        return redirect()->route('user.view')->with($notification);
    }

    public function getEdit(User $user)
    {

        return view('backend.user.edit_user', compact('user'));
    }
    public function updateUser(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->update();

        $notification = array(
            'message' => 'The user has been updated.',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $notification = array(
            'message' => 'The user has been deleted.',
            'alert-type' => 'error',
        );

        return redirect()->route('user.view')->with($notification);
    }
}

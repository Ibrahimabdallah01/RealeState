<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        return view('admin.index');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }

    public function admin_profile(Request $request)
    {
        //$data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.admin_profile');
    }

    public function admin_profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->phone = trim($request->phone);
        $user->address = trim($request->address);
        $user->email = trim($request->email);
        $user->website = trim($request->website);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        if (!empty($request->file('photo'))) 
         // Handle the profile picture upload
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile_pictures'), $filename);

        // Remove old profile picture if it exists
        if (!empty($user->photo) && file_exists(public_path('uploads/profile_pictures/' . $user->photo))) {
            unlink(public_path('uploads/profile_pictures/' . $user->photo));
        }

        // Save the new profile picture
        $user->photo = $filename;
    }
        $user->about = trim($request->about);
        $user->save();

        return redirect('admin/profile')->with('sucess', 'Profile Successful Updated');
    }

    public function AdminLogout(Request $request)
    {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('admin/login');
    }

}
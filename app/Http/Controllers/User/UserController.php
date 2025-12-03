<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function details()
    {
        $user = Auth::user();
        return view('user.account.details.index', compact('user'));
    }

    public function updateDetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|required_with:old_password|min:8|confirmed',
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;

        if ($request->hasFile('image')) {
            // Old deletion logic commented out as storage path changed
            $imageName = $request->file('image')->store('private/images/users');
            $user->image = $imageName;
        }

        if ($request->new_password) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Old password does not match!');
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        return back()->with('status', 'Details updated successfully!');
    }
}

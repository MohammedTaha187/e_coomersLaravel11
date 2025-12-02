<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
    public function userAdmin() // Renamed from index to userAdmin to avoid conflict, assuming this is the admin view
    {
        $users = User::where('is_blocked', false)->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function blockedUsers()
    {
        $users = User::where('is_blocked', true)->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.blocked', compact('users'));
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.block', compact('user'));
    }

    public function storeBlock(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot block yourself!');
        }

        $user->is_blocked = true;
        $user->save();

        BlockedUser::create([
            'user_id' => $user->id,
            'reason' => $request->reason,
            'blocked_by' => Auth::id(),
        ]);

        return redirect()->route('admin.users')->with('status', 'User has been blocked successfully!');
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->is_blocked = false;
        $user->save();

        $user->blockedInfo()->delete();

        return redirect()->route('admin.users.blocked')->with('status', 'User has been unblocked successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'utype' => 'required',
        ]);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot change your own role!');
        }


        $user->utype = $request->utype;
        $user->save();

        return redirect()->route('admin.users')->with('status', 'User updated successfully!');
    }
}

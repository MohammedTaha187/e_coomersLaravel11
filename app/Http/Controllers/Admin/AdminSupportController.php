<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminSupportController extends Controller
{
    public function index()
    {
        $tickets = DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->select('tickets.*', 'users.name as user_name')
            ->orderBy('tickets.created_at', 'desc')
            ->paginate(10);
        return view('admin.support.index', compact('tickets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,closed',
        ]);

        DB::table('tickets')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Ticket status updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('tickets')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }
}

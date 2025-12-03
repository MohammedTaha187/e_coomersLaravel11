<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->orderBy('created_at', 'desc')->get();
        return view('admin.taskboard.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:todo,in_progress,done',
            'due_date' => 'nullable|date',
        ]);

        DB::table('tasks')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:todo,in_progress,done',
        ]);

        DB::table('tasks')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Task status updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoresliderRequest;
use App\Http\Requests\UpdatesliderRequest;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('id', 'DESC')->paginate(12);
        return view('admin.slides.index', compact('slides'));
    }


    public function create()
    {
        return view('admin.slides.create');
    }


    public function store(StoresliderRequest $request)
    {
        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/slides', $imageName, 'public');
            $slide->image = $path;
        } else {
            return redirect()->back()->withErrors(['image' => 'Image file is missing or invalid.'])->withInput();
        }

        $slide->save();

        return redirect()->route('admin.slides')->with('status', 'Slide has been added successfully!');
    }



    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(UpdatesliderRequest $request)
    {
        $slide = Slide::find($request->id);

        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/slides', $imageName, 'public');
            $slide->image = $path;
        }

        $slide->save();
        return redirect()->route('admin.slides')->with('status', 'Slide has been updated successfully!');
    }


    public function destroy($id)
    {
        $slide = Slide::find($id);
        if ($slide) {
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
            $slide->delete();
            return redirect()->route('admin.slides')->with('success', 'Slide deleted successfully.');
        }
        return redirect()->route('admin.slides')->with('error', 'Slide not found.');
    }

    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        $slides = Slide::when($search, function ($query) use ($search) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('tagline', 'LIKE', "%{$search}%")
                ->orWhere('subtitle', 'LIKE', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.slides.index', compact('slides'));
    }
}

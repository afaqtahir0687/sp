<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::orderBy('id', 'desc')->get();
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:authors',
            'name_ar' => 'nullable|unique:authors',
            'status' => 'required',
        ]);

        $author = new Author();
        $author->name_en = $request->name_en;
        $author->name_ar = $request->name_ar;
        $author->slug = Str::slug($request->name_en);
        $author->bio_en = $request->bio_en;
        $author->bio_ar = $request->bio_ar;
        $author->status = $request->status;
        
        if ($request->hasFile('image')) {
            $author->image = $request->file('image')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name_en' => 'required|unique:authors,name_en,' . $author->id,
            'name_ar' => 'nullable|unique:authors,name_ar,' . $author->id,
            'status' => 'required',
        ]);

        $author->name_en = $request->name_en;
        $author->name_ar = $request->name_ar;
        $author->slug = Str::slug($request->name_en);
        $author->bio_en = $request->bio_en;
        $author->bio_ar = $request->bio_ar;
        $author->status = $request->status;

        if ($request->hasFile('image')) {
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $author->image = $request->file('image')->store('authors', 'public');
        }

        $author->save();

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully.');
    }
}

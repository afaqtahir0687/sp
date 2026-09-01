<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::orderBy('id', 'desc')->get();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:publishers',
            'name_ar' => 'nullable|unique:publishers',
            'status' => 'required',
        ]);

        $publisher = new Publisher();
        $publisher->name_en = $request->name_en;
        $publisher->name_ar = $request->name_ar;
        $publisher->slug = Str::slug($request->name_en);
        $publisher->description_en = $request->description_en;
        $publisher->description_ar = $request->description_ar;
        $publisher->status = $request->status;
        
        if ($request->hasFile('logo')) {
            $publisher->logo = $request->file('logo')->store('publishers', 'public');
        }

        $publisher->save();

        return redirect()->route('admin.publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name_en' => 'required|unique:publishers,name_en,' . $publisher->id,
            'name_ar' => 'nullable|unique:publishers,name_ar,' . $publisher->id,
            'status' => 'required',
        ]);

        $publisher->name_en = $request->name_en;
        $publisher->name_ar = $request->name_ar;
        $publisher->slug = Str::slug($request->name_en);
        $publisher->description_en = $request->description_en;
        $publisher->description_ar = $request->description_ar;
        $publisher->status = $request->status;

        if ($request->hasFile('logo')) {
            if ($publisher->logo) {
                Storage::disk('public')->delete($publisher->logo);
            }
            $publisher->logo = $request->file('logo')->store('publishers', 'public');
        }

        $publisher->save();

        return redirect()->route('admin.publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher)
    {
        if ($publisher->logo) {
            Storage::disk('public')->delete($publisher->logo);
        }
        $publisher->delete();

        return redirect()->route('admin.publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}

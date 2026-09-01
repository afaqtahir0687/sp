<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('sort_order')->latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en'    => 'required|string|max:255',
            'image'      => 'nullable|image|max:2048',
            'status'     => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
        ]);

        $client = new Client();
        if ($request->hasFile('image')) {
            $client->image = $request->file('image')->store('clients', 'public');
        }
        $client->name_en    = $request->name_en;
        $client->name_ar    = $request->name_ar;
        $client->website    = $request->website;
        $client->status     = $request->status;
        $client->sort_order = $request->sort_order ?? 0;
        $client->save();

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en'    => 'required|string|max:255',
            'image'      => 'nullable|image|max:2048',
            'status'     => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
        ]);

        $client = Client::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($client->image) {
                Storage::disk('public')->delete($client->image);
            }
            $client->image = $request->file('image')->store('clients', 'public');
        }
        $client->name_en    = $request->name_en;
        $client->name_ar    = $request->name_ar;
        $client->website    = $request->website;
        $client->status     = $request->status;
        $client->sort_order = $request->sort_order ?? 0;
        $client->save();

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->image) {
            Storage::disk('public')->delete($client->image);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}

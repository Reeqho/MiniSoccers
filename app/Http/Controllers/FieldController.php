<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    // Admin
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // index
        // search
        $search = request('search');
        $fields = Field::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(5)->withQueryString();

        return view('admin.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('fields', 'public');
            // $request->merge(['image' => $image]);
        }

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Field::create([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description' => $request->description,
            'image' => $image

            ?? null,
        ]);

        // redirect with success message
        return redirect()->route('fields.index')->with('success', 'Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        // detail
        $field = Field::findOrfail($id);
        // search
        $search = $request->get('search');
        $bookings = $field->bookings()->with('user')->when($search, function ($query, $search) {
            return $query->whereHas('user', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%");
            });
        })->paginate(5)->withQueryString();

        return view('admin.fields.detail', compact('field', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        // edit
        $field = Field::findOrfail($id);

        return view('admin.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // update
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('fields', 'public');
        }
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $field = Field::findOrfail($id);
        $field->update([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
            'description' => $request->description,
            'image' => $image ?? $field->image,
        ]);
        // redirect with success message
        if ($field) {
            return redirect()->route('fields.index')->with('success', 'Field updated successfully.');
        } else {
            return redirect()->route('fields.index')->with('error', 'Failed to update field.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // destroy
        $field = Field::findOrfail($id);
        $deleted = $field->delete();
        // redirect with success message
        if ($deleted) {
            return redirect()->route('fields.index')->with('success', 'Field deleted successfully.');
        } else {
            return redirect()->route('fields.index')->with('error', 'Failed to delete field.');
        }
    }

    // Customers

    public function list()
    {
        // list
        $fields = Field::all();

        return view('customers.fields.index', compact('fields'));
    }
}

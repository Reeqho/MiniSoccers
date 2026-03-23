<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
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
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);

        Field::create($request->all());
        // redirect with success message
        return redirect()->route('fields.index')->with('success', 'Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        //
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
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'nullable',
        ]);
        $field = Field::findOrfail($id);
        $field->update($request->all());
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
}

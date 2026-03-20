<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::with(['user', 'field'])->latest()->paginate(5);
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // show
        $booking = Booking::findOrFail($id);
        $booking->load(['user', 'field']);
        return view('admin.bookings.detail', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // edit
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $fields = Field::all();
        return view('admin.bookings.edit', compact('booking', 'users', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // update
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'field_id' => 'required|exists:fields,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'total_price' => 'required|numeric|min:0',
        ]);
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        // redirect with success message
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // hapus
        $booking = Booking::findOrFail($id);
        $deleted = $booking->delete();
        // redirect with success message
        if($deleted) {
            return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
        } else {
            return redirect()->route('bookings.index')->with('error', 'Failed to delete booking.');
        }
    }
}

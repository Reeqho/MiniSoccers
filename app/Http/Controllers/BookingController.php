<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Admin

        // index
        // search
        /** @var LengthAwarePaginator $bookings */
        $search = request('search');

        $bookings = Booking::with(['user', 'field'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('field', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()->paginate(5)->withQueryString();

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
        if ($deleted) {
            return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
        } else {
            return redirect()->route('bookings.index')->with('error', 'Failed to delete booking.');
        }
    }

    // Customers

    public function userBookings()
    {
        $user = auth()->user();
        $bookings = Booking::with('field')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('customers.fields.index', compact('bookings'));
    }

    public function createBooking(int $id)
    {
        $field = Field::findOrFail($id);
        if ($field == null) {
            return redirect()->route('field.list')->with('error', 'Lapangan tidak ditemukan.');
        } else {
            return view('customers.bookings.create', compact('field'));
        }
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'field_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // cek jadwal bentrok
        $exists = Booking::where('field_id', $request->field_id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'time' => 'Jadwal sudah dibooking!',
            ]);
        }

        // HITUNG HARGA
        $field = Field::find($request->field_id);

        $start = Carbon::parse($request->start_time);
        $end = Carbon::parse($request->end_time);

        $hours = $start->diffInHours($end);
        $total = $hours * $field->price_per_hour;

        // SIMPAN
        Booking::create([
            'user_id' => auth()->id(),
            'field_id' => $request->field_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('field.list')
            ->with('success', 'Booking berhasil!');
    }

    public function check($fieldId, Request $request)
    {
        $bookings = Booking::where('field_id', $fieldId)
            ->where('date', $request->date)
            ->get(['start_time', 'end_time']);

        return response()->json($bookings);
    }
}

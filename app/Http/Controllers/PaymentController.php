<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($bookingId)
    {
        $booking = Booking::where('user_id', auth()->id())
            ->findOrFail($bookingId);

        return view('customers.bookings.booking-payment', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $bookingId)
    {
        $booking = Booking::where('user_id', auth()->id())
            ->findOrFail($bookingId);

        // upload bukti
        if ($request->hasFile('proof')) {
            $proof = $request->file('proof')->store('payments', 'public');
        }

        // dd($request->all(), $proof);

        Booking::where('id', $bookingId)->update(['status' => 'paid']);

        Payment::create([
            'booking_id' => $booking->id,
            'method' => $request->payment_method,
            'amount' => $booking->total_price,
            'status' => 'pending',
            'proof' => $proof ?? null,
        ]);

        return redirect()->route('user.bookings.history')
            ->with('success', 'Pembayaran dikirim, menunggu verifikasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

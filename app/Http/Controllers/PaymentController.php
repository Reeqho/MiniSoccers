<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // admin confirmation the payment

    public function admin_confirmation()
    {
        // with search by user name or field name
        $payments = Payment::with(['booking.user', 'booking.field'])
            ->when(request('search'), function ($query, $search) {
                $query->whereHas('booking.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('booking.field', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.payment.confirmation-payment', compact('payments'));
    }

    public function approve($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->update(['status' => 'success']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function reject($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->update(['status' => 'failed']);

        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak');
    }

    // unused methods for resource controller

    public function index() {}

    public function show(Payment $payment) {}

    public function edit(Payment $payment) {}

    public function update(Request $request, Payment $payment) {}

    public function destroy(Payment $payment) {}

    public function store() {}

    public function create() {}

    // Customer

    public function customer_payment($bookingId)
    {
        $booking = Booking::where('user_id', auth()->id())
            ->findOrFail($bookingId);

        // $payment = Payment::where('booking_id', $bookingId)->first();

        return view('customers.bookings.booking-payment', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function customer_paymentStore(Request $request, $bookingId)
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
}

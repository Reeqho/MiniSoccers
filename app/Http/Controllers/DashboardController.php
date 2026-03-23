<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {

        $totalBookings = Booking::count();
        $totalFields = Field::count();
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');

        $recentBookings = Booking::with(['user', 'field'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'totalFields',
            'totalRevenue',
            'recentBookings'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Locale;
use App\Models\MenuItem;
use App\Models\Staff;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);

        $stats = [];
        $upcomingBookings = collect();

        if ($localeId) {
            $stats = [
                'today'        => Booking::where('locale_id', $localeId)->whereDate('booking_date', today())->count(),
                'month'        => Booking::where('locale_id', $localeId)->whereMonth('booking_date', now()->month)->whereYear('booking_date', now()->year)->count(),
                'staff'        => Staff::where('locale_id', $localeId)->where('is_active', true)->count(),
                'menu_items'   => MenuItem::where('locale_id', $localeId)->where('is_active', true)->count(),
            ];

            $upcomingBookings = Booking::where('locale_id', $localeId)
                ->whereDate('booking_date', '>=', today())
                ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_CONFIRMED])
                ->orderBy('booking_date')
                ->orderBy('booking_time')
                ->limit(8)
                ->get();
        }

        return view('dashboard', compact('stats', 'upcomingBookings', 'localeId'));
    }
}

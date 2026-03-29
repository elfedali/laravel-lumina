<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Locale;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);
        $search   = $request->get('search');
        $status   = $request->get('status');
        $date     = $request->get('date');

        $bookings = Booking::where('locale_id', $localeId)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('full_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($date,   fn ($q) => $q->whereDate('booking_date', $date))
            ->orderByDesc('booking_date')
            ->orderBy('booking_time')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'pending'   => Booking::where('locale_id', $localeId)->where('status', Booking::STATUS_PENDING)->count(),
            'confirmed' => Booking::where('locale_id', $localeId)->where('status', Booking::STATUS_CONFIRMED)->count(),
            'today'     => Booking::where('locale_id', $localeId)->whereDate('booking_date', today())->count(),
        ];

        return view('booking.index', compact('bookings', 'stats'));
    }

    public function create()
    {
        return view('booking.create');
    }

    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();
        $data['locale_id'] = $request->session()->get(Locale::ACTIVE_LOCALE);
        Booking::create($data);

        return redirect()->route('booking.index')->with('success', 'Réservation ajoutée avec succès.');
    }

    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        return redirect()->route('booking.index')->with('success', 'Réservation mise à jour.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled,completed']);
        $booking->update(['status' => $request->status]);

        if ($request->expectsJson()) {
            return response()->json([
                'success'       => true,
                'status'        => $booking->status,
                'status_label'  => $booking->status_label,
                'status_color'  => $booking->status_color,
            ]);
        }

        return redirect()->route('booking.index')->with('success', 'Statut mis à jour.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Réservation supprimée.');
    }
}

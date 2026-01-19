<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('guest.booking.index');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $checkInDate = $request->check_in_date;
        $checkOutDate = $request->check_out_date;

        // Get available rooms - rooms that don't have overlapping bookings
        $availableRooms = Room::where('status', 'available')
            ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('status', '!=', 'cancelled')
                    ->where(function ($q) use ($checkInDate, $checkOutDate) {
                        // Check for date overlap
                        $q->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                          ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                          ->orWhere(function ($q2) use ($checkInDate, $checkOutDate) {
                              $q2->where('check_in_date', '<=', $checkInDate)
                                 ->where('check_out_date', '>=', $checkOutDate);
                          });
                    });
            })
            ->with('images')
            ->get();

        return view('guest.booking.available-rooms', compact('availableRooms', 'checkInDate', 'checkOutDate'));
    }

    public function showRoom($id, Request $request)
    {
        $room = Room::with('images')->findOrFail($id);
        $checkInDate = $request->query('check_in_date');
        $checkOutDate = $request->query('check_out_date');

        return view('guest.booking.room-details', compact('room', 'checkInDate', 'checkOutDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:20',
            'guest_email' => 'required|email|max:255',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        // Double booking prevention - check for overlapping bookings
        $hasOverlap = Booking::where('room_id', $request->room_id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('check_in_date', '<=', $request->check_in_date)
                            ->where('check_out_date', '>=', $request->check_out_date);
                      });
            })
            ->exists();

        if ($hasOverlap) {
            return back()->withErrors(['error' => 'This room is not available for the selected dates.'])->withInput();
        }

        $booking = Booking::create([
            'room_id' => $request->room_id,
            'guest_name' => $request->guest_name,
            'guest_phone' => $request->guest_phone,
            'guest_email' => $request->guest_email,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'status' => 'confirmed',
        ]);

        return redirect()->route('booking.confirmation', $booking->id)->with('success', 'Booking confirmed successfully!');
    }

    public function confirmation($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        return view('guest.booking.confirmation', compact('booking'));
    }
}

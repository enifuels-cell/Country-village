<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(string $id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated successfully!');
    }

    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully!');
    }
}

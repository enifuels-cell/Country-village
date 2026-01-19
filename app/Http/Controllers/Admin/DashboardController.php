<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalBookings = Booking::count();
        $recentBookings = Booking::with('room')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalRooms', 'availableRooms', 'totalBookings', 'recentBookings'));
    }
}

@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Back to Bookings</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h1 class="text-2xl font-bold">Booking #{{ $booking->id }}</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Guest Information</h2>
                    <div class="space-y-2">
                        <div>
                            <p class="text-sm text-gray-600">Name</p>
                            <p class="font-medium">{{ $booking->guest_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-medium">{{ $booking->guest_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone</p>
                            <p class="font-medium">{{ $booking->guest_phone }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-4">Booking Information</h2>
                    <div class="space-y-2">
                        <div>
                            <p class="text-sm text-gray-600">Room</p>
                            <p class="font-medium">{{ $booking->room->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Check-In Date</p>
                            <p class="font-medium">{{ $booking->check_in_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Check-Out Date</p>
                            <p class="font-medium">{{ $booking->check_out_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Status</p>
                            <span class="inline-block px-2 py-1 text-xs rounded-full 
                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4">Update Status</h2>
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('PUT')
                    <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

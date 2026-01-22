@extends('layouts.app')

@section('title', 'Available Rooms')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Available Rooms</h1>
        <p class="mt-2 text-gray-600">Check-in: {{ \Carbon\Carbon::parse($checkInDate)->format('M d, Y') }} | Check-out: {{ \Carbon\Carbon::parse($checkOutDate)->format('M d, Y') }}</p>
    </div>

    @if($availableRooms->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($availableRooms as $room)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($room->images->count() > 0)
                        <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                            <span class="text-gray-500">No image available</span>
                        </div>
                    @endif
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $room->name }}</h2>
                        <p class="mt-2 text-gray-600">{{ Str::limit($room->description, 100) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <div>
                                <p class="text-2xl font-bold text-blue-600">${{ number_format($room->price, 2) }}</p>
                                <p class="text-sm text-gray-500">per night</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Capacity: {{ $room->capacity }} guests</p>
                            </div>
                        </div>
                        <a href="{{ route('booking.room', ['id' => $room->id, 'check_in_date' => $checkInDate, 'check_out_date' => $checkOutDate]) }}" 
                           class="mt-4 block w-full bg-blue-600 text-white text-center px-4 py-2 rounded hover:bg-blue-700">
                            Book Now
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <p class="text-xl text-gray-600">No rooms available for the selected dates.</p>
            <a href="{{ route('home') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Try Different Dates
            </a>
        </div>
    @endif
</div>
@endsection

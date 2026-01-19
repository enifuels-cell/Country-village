@extends('layouts.app')

@section('title', $room->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($room->images->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                @foreach($room->images as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $room->name }}" class="w-full h-64 object-cover rounded">
                @endforeach
            </div>
        @else
            <div class="w-full h-96 bg-gray-300 flex items-center justify-center">
                <span class="text-gray-500 text-xl">No images available</span>
            </div>
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $room->name }}</h1>
            <p class="mt-4 text-gray-600">{{ $room->description }}</p>
            
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm text-gray-600">Price per night</p>
                    <p class="text-2xl font-bold text-blue-600">${{ number_format($room->price, 2) }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-sm text-gray-600">Capacity</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $room->capacity }} guests</p>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-600">Selected Dates</p>
                <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($checkInDate)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($checkOutDate)->format('M d, Y') }}</p>
            </div>

            <form action="{{ route('booking.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="check_in_date" value="{{ $checkInDate }}">
                <input type="hidden" name="check_out_date" value="{{ $checkOutDate }}">

                <div>
                    <label for="guest_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="guest_name" id="guest_name" required value="{{ old('guest_name') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                </div>

                <div>
                    <label for="guest_phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="guest_phone" id="guest_phone" required value="{{ old('guest_phone') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                </div>

                <div>
                    <label for="guest_email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="guest_email" id="guest_email" required value="{{ old('guest_email') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 font-semibold">
                    Confirm Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

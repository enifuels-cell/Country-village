@extends('layouts.app')

@section('title', 'Booking Confirmation')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-green-600 text-white px-6 py-8 text-center">
            <svg class="mx-auto h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h1 class="text-3xl font-bold mt-4">Booking Confirmed!</h1>
            <p class="mt-2 text-green-100">Your reservation has been successfully created</p>
        </div>

        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Booking Details</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Booking ID:</span>
                    <span class="font-semibold">#{{ $booking->id }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Room:</span>
                    <span class="font-semibold">{{ $booking->room->name }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Guest Name:</span>
                    <span class="font-semibold">{{ $booking->guest_name }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-semibold">{{ $booking->guest_email }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Phone:</span>
                    <span class="font-semibold">{{ $booking->guest_phone }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Check-In:</span>
                    <span class="font-semibold">{{ $booking->check_in_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Check-Out:</span>
                    <span class="font-semibold">{{ $booking->check_out_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">Status:</span>
                    <span class="font-semibold text-green-600">{{ ucfirst($booking->status) }}</span>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 p-4 rounded">
                <p class="text-sm text-gray-700">
                    A confirmation email has been sent to <strong>{{ $booking->guest_email }}</strong>. 
                    Please check your inbox for further details.
                </p>
            </div>

            <a href="{{ route('home') }}" class="mt-6 block w-full bg-blue-600 text-white text-center px-6 py-3 rounded-md hover:bg-blue-700 font-semibold">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection

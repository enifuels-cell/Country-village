@extends('layouts.app')

@section('title', 'Book a Room - Country Village Hotel')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-8">
            <h1 class="text-3xl font-bold">Welcome to Country Village Hotel</h1>
            <p class="mt-2 text-blue-100">Find your perfect room for a comfortable stay</p>
        </div>

        <div class="p-6">
            <h2 class="text-2xl font-semibold mb-4">Check Availability</h2>
            <form action="{{ route('booking.check-availability') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="check_in_date" class="block text-sm font-medium text-gray-700">Check-In Date</label>
                        <input type="date" name="check_in_date" id="check_in_date" required 
                               min="{{ date('Y-m-d') }}"
                               value="{{ old('check_in_date') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                    </div>
                    <div>
                        <label for="check_out_date" class="block text-sm font-medium text-gray-700">Check-Out Date</label>
                        <input type="date" name="check_out_date" id="check_out_date" required 
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               value="{{ old('check_out_date') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2 border">
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 font-semibold">
                    Check Availability
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

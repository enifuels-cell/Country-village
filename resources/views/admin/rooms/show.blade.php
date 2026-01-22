@extends('layouts.admin')

@section('title', 'Room Details')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('admin.rooms.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Back to Rooms</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h1 class="text-2xl font-bold">{{ $room->name }}</h1>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Price per Night</p>
                    <p class="text-xl font-bold">${{ number_format($room->price, 2) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Capacity</p>
                    <p class="text-xl font-bold">{{ $room->capacity }} guests</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <span class="inline-block px-2 py-1 text-xs rounded-full {{ $room->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($room->status) }}
                    </span>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-sm text-gray-600">Description</p>
                <p class="mt-2">{{ $room->description }}</p>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Room Images</h2>
                
                <form action="{{ route('admin.rooms.images.store', $room->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <input type="file" name="images[]" multiple accept="image/*" required
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Upload
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-3 gap-4">
                    @forelse($room->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Room Image" class="w-full h-32 object-cover rounded">
                            <form action="{{ route('admin.rooms.images.destroy', $image->id) }}" method="POST" class="absolute top-2 right-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this image?')" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-3">No images uploaded yet</p>
                    @endforelse
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4">Recent Bookings</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Guest</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Check-In</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Check-Out</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($room->bookings()->orderBy('created_at', 'desc')->take(5)->get() as $booking)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $booking->guest_name }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $booking->check_in_date->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $booking->check_out_date->format('M d, Y') }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No bookings yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

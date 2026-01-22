<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomImageController extends Controller
{
    public function store(Request $request, $roomId)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $room = Room::findOrFail($roomId);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('room-images', 'public');
                
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function destroy($id)
    {
        $image = RoomImage::findOrFail($id);
        
        // Delete the file from storage
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}

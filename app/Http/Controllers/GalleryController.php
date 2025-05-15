<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 4; // Items per page
        $mediaItems = Media::query()
            ->where('collection_name', 'images') // Filter by collection if needed
            ->latest()
            ->paginate($perPage);

        // foreach ($mediaItems as $key => $media) {
        //     dd($media->getPath());
        // }

        return view('gallery.index', compact('mediaItems'));
    }

    public function destroy(Media $media)
    {
        $media->delete();
        return back()->with('success', 'Media deleted successfully');
    }
}

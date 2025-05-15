<?php

namespace App\Http\Controllers;

use App\Models\MediaLibrary;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        // $model = MediaLibrary::find(7); // Adjust this to get your specific model
        // $mediaItems = $model->getMedia("*");

        $mediaItems = Media::all();

        //dd($mediaItems);

        return view('media-library.upload-form');
    }


    public function store(Request $request)
    {
        $model = MediaLibrary::create([
            'file_name' => $request->name,
            'file_size' => $request->size,
            'file_type' => $request->type,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $model->addMedia($file)->toMediaCollection('products'); // 'images' is the collection name
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully');
    }
}

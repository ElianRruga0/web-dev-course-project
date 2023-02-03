<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        // // Public Folder
        $request->image->move(public_path('images'), $imageName);


        return $imageName;
    }
}

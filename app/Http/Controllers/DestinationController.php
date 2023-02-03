<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $destinations = Destination::with('activities')->get();
        return response()->json([
            'status' => 'success',
            'destinations' => $destinations,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);


        $imageController = new ImageController();
        $storeImage = $imageController->storeImage($request);


        $destination = Destination::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $storeImage,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Destination created successfully',
            'destination' => $destination,
        ]);
    }


    public function show($id)
    {
        $destination = Destination::find($id);
        return response()->json([
            'status' => 'success',
            'destination' => $destination,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $destination = Destination::find($id);
        $destination->name = $request->name;
        $destination->description = $request->description;

        $destination->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Destination updated successfully',
            'destination' => $destination,
        ]);
    }


    public function destroy($id)
    {
        $destination = Destination::find($id);
        $destination->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Destination deleted successfully',
            'destination' => $destination,
        ]);
    }
}

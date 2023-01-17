<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityType;
use App\Models\Destination;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $activities = Activity::with('destination')->with('activity_type')->get();
        return response()->json([
            'status' => 'success',
            'activities' => $activities,
        ]);
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:255',
    //         'image' => 'required|string'
    //     ]);

    //     $activity = Destination::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'image' => $request->image,

    //     ]);

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Destination created successfully',
    //         'activity' => $activity,
    //     ]);
    // }


    public function show($id)
    {
        $activity = Activity::find($id)->with('destination')->with('activity_type')->get();
        return response()->json([
            'status' => 'success',
            'activity' => $activity,
        ]);
    }


    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:255',
    //         'image' => 'required|string'
    //     ]);

    //     $activity = Destination::find($id);
    //     $activity->name = $request->name;
    //     $activity->description = $request->description;
    //     $activity->image = $request->image;

    //     $activity->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Destination updated successfully',
    //         'activity' => $activity,
    //     ]);
    // }


    // public function destroy($id)
    // {
    //     $activity = Destination::find($id);
    //     $activity->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Destination deleted successfully',
    //         'activity' => $activity,
    //     ]);
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $activities = Activity::with('destination')->with('activity_type')->get();
        return response()->json([
            'status' => 'success',
            'activities' => $activities,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|string',
            'startTime' => 'required|date|after:today',
            'endTime' => 'required|date',
            'minGuests' => 'required|integer',
            'maxGuests' => 'required|integer',
            'destination_id' => 'required|exists:destinations,id',
            'activity_id' => 'required|exists:activities,id',
        ]);

        $activity = Activity::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'minGuests' => $request->minGuests,
            'maxGuests' => $request->maxGuests,
            'destination_id' => $request->destination_id,
            'activity_id' => $request->activity_id,

        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Activity created successfully',
            'activity' => $activity,
        ]);
    }


    public function show($id)
    {
        $activity = Activity::find($id)->with('destination')->with('activity_type')->get();
        return response()->json([
            'status' => 'success',
            'activity' => $activity,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|string',
            'startTime' => 'required|date|after:today',
            'endTime' => 'required|date',
            'minGuests' => 'required|integer',
            'maxGuests' => 'required|integer',
            'destination_id' => 'required|exists:destinations,id',
            'activity_id' => 'required|exists:activities,id',
        ]);

        $activity = Activity::find($id);
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->image = $request->image;
        $activity->startTime = $request->startTime;
        $activity->endTime = $request->endTime;
        $activity->minGuests = $request->minGuests;
        $activity->maxGuests = $request->maxGuests;
        $activity->destination_id = $request->destination_id;
        $activity->activity_id = $request->activity_id;


        $activity->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity updated successfully',
            'activity' => $activity,
        ]);
    }


    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity deleted successfully',
            'activity' => $activity,
        ]);
    }
}

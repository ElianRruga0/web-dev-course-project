<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $activityTypes = ActivityType::all();
        return response()->json([
            'status' => 'success',
            'activity_types' => $activityTypes,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);


        $activityType = ActivityType::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Activity Type created successfully',
            'activity_types' => $activityType,
        ]);
    }


    public function show($id)
    {
        $activityTypes = ActivityType::find($id);
        return response()->json([
            'status' => 'success',
            'activity_type' => $activityTypes,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $activityType = ActivityType::find($id);
        $activityType->name = $request->name;
        $activityType->icon = $request->icon;

        $activityType->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity  updated successfully',
            'activity_type' => $activityType,
        ]);
    }


    public function destroy($id)
    {
        $activityType = ActivityType::find($id);
        $activityType->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Activity Type deleted successfully',
            'activity_type' => $activityType,
        ]);
    }
}

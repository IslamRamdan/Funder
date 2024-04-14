<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    // get Timelines by property id
    public function getTimelines($id)
    {
        $property = Property::find($id);
        if (!$property) {
            return response()->json([
                'message' => 'property not found',
            ], 400);
        }

        return response()->json([
            'success' => true,
            "timelines" => $property->timelines,
        ]);
    }

    // create Timelines 
    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'property_id' => 'required',
        ]);

        $property = Property::find($request->property_id);
        if (!$property) {
            return response()->json([
                'message' => 'property not found',
            ], 400);
        }

        $timeline = new Timeline();
        $timeline->date = $request->date;
        $timeline->title = $request->title;
        $timeline->description = $request->description;
        $timeline->property_id = $request->property_id;
        $timeline->save();

        return response()->json([
            'success' => true,
            'message' => 'timeline created successfully'
        ]);
    }

    // update Timelines 
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $timeline = Timeline::find($id);
        if (!$timeline) {
            return response()->json([
                'error' => 'timeline not found',
            ], 400);
        }

        $timeline->date = $request->date;
        $timeline->title = $request->title;
        $timeline->description = $request->description;
        $timeline->save();

        return response()->json([
            'success' => true,
            'message' => 'timeline updated successfully'
        ]);
    }

    // delete Timelines 
    public function delete($id)
    {
        $timeline = Timeline::find($id);
        if (!$timeline) {
            return response()->json([
                'error' => 'timeline not found',
            ], 400);
        }

        $timeline->delete();

        return response()->json([
            'success' => true,
            'message' => 'timeline deleted successfully'
        ]);
    }
}

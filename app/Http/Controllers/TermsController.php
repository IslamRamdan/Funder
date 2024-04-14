<?php

namespace App\Http\Controllers;

use App\Models\Terms;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    // all terms
    public function terms()
    {
        $terms = Terms::get();

        return response()->json([
            'success' => true,
            'terms' => $terms
        ]);
    }

    // add terms 
    public function addTerm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $term = new Terms();
        $term->title = $request->title;
        $term->description = $request->description;
        $term->save();

        return response()->json([
            'success' => true,
            'message' => 'term added successfully'
        ]);
    }

    // update terms 
    public function updateTerm(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $term = Terms::find($id);
        if (!$term) {
            return response()->json([
                'error' => 'term not found',
            ], 400);
        }
        $term->title = $request->title;
        $term->description = $request->description;
        $term->save();

        return response()->json([
            'success' => true,
            'message' => 'term updated successfully'
        ]);
    }

    // delete term
    public function delete($id)
    {
        $term = Terms::find($id);
        if (!$term) {
            return response()->json([
                'error' => 'term not found',
            ], 400);
        }

        $term->delete();
        return response()->json([
            'success' => true,
            'message' => 'term deleted successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // all categories
    public function all()
    {
        $categories = Category::get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    // get category by id
    public function cateById($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'category not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    // add category
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'category saved successfully'
        ]);
    }

    // add category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'error' => 'category not found'
            ], 400);
        }

        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'category updated successfully'
        ]);
    }

    // delete a category
    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'category not found'
            ], 400);
        }

        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'category deleted successfully'
        ]);
    }
}

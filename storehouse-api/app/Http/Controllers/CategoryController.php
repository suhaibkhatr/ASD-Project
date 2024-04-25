<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Storehouse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $storehouse_id)
    {
        return response()->json(
            Category::where("storehouse_id", $storehouse_id)->get(),
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, int $storehouse_id)
    {
        $category = Category::create([
            "title" => $request->title,
            "storehouse_id" => $storehouse_id,
        ]);

        return response()->json($category, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $storehouse_id, int $category_id)
    {
        $category = Category::find($category_id);
        if (empty($category)) {
            return response()->json(["success" => 0], 404);
        }
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateCategoryRequest $request,
        int $storehouse_id,
        int $category_id
    ) {
        $category = Category::find($category_id);
        if ($category) {
            $category->update(["title" => $request->title ?? $category->title]);
            return response()->json($category, 200);
        }
        return response()->json(["success" => 0], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $storehouse_id, int $category_id)
    {
        $category = Category::find($category_id);
        if ($category) {
            $category->delete();
            return response()->json(["succes" => 1], 200);
        }
        return response()->json(["succes" => 0], 404);
    }
}

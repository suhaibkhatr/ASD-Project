<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Storehouse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $storehouse_id)
    {
        $products = Product::where("storehouse_id", $storehouse_id)->get();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, int $storehouse_id)
    {
        $product = Product::create([
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price ?? 1,
            "quantity" => $request->quantity ?? 1,
            "storehouse_id" => $storehouse_id,
        ]);

        if ($product && !empty($request->categories)) {
            $data = [];
            foreach ($request->categories as $id) {
                $data[] = [
                    "category_id" => $id,
                    "product_id" => $product->id,
                ];
            }
            CategoryProduct::insert($data);
        }

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $storehouse, int $product_id)
    {
        $product = Product::find($product_id);
        if ($product) {
            return response()->json($product, 200);
        }
        return response()->json(["success" => 0], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateProductRequest $request,
        int $storehouse_id,
        int $product_id
    ) {
        $product = Product::find($product_id);
        if ($product) {
            $product->update([
                "title" => $request->title ?? $product->title,
                "description" => $request->description ?? $product->description,
                "price" => $request->price ?? $product->price,
                "quantity" => $request->quantity ?? $product->quantity,
            ]);

            if ($product && !empty($request->categories)) {
                CategoryProduct::where("product_id", $product->id)->delete();
                $data = [];
                foreach ($request->categories as $id) {
                    $data[] = [
                        "category_id" => $id,
                        "product_id" => $product->id,
                    ];
                }
                CategoryProduct::insert($data);
            }

            return response()->json($product, 200);
        }
        return response()->json(["success" => 0], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $storehouse_id, int $product_id)
    {
        $product = Product::find($product_id);
        if ($product && $product->delete()) {
            return response()->json(["succes" => 1], 200);
        }
        return response()->json(["succes" => 0], 404);
    }
}

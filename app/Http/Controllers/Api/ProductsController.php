<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $products = Product::filter($request->query())
            ->with(['category:id,name', 'store:id,name', 'tags:id,name']) // بحدد ايه هيرجع في الريسبونس
            ->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|gt:price',
        ]);

        return Product::query()->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
//        return new ProductResource($product);
        $product = $product
            ->load(['category:id,name', 'store:id,name', 'tags:id,name']);
        return response()->json(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|gt:price',
        ]);

        return Product::query()->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
       Product::destroy($id);
       return  response()->json([
           'message' => 'Product deleted successfully'

       ]);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application
    {
        $products = Product::query()->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Factory|Application
    {
        $product = Product::query()->findOrFail($id);

        $tags = implode(',', $product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($request->except('tags'));

        $tags =  json_decode($request->post('tags'));
        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::query()->create([
                    'name' => $item->value,
                    'slug' => $slug
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

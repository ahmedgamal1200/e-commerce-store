<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected CartRepository $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    public function index(): View
    {
        $items = $this->cart->get();
//        dd($items);
        return view('front.cart', [
            'cart' => $this->cart
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product = Product::query()->findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity'));

        if($request->expectsJson()){

            return response()->json([
                'message' => 'Item added to cart',
            ], 201);
        }
        return redirect()->route('cart.index')
            ->with('success', 'Product added to cart!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): void
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);

        $this->cart->update($id, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): array
    {
        $this->cart->delete($id);
        return [
            'message' => 'Item deleted successfully!',
        ];
    }
}

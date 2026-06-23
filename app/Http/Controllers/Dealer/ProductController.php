<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\DealerProduct;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $dealer = \App\Models\DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $dealerProductIds = DealerProduct::where('dealer_id', $dealer->id)
            ->pluck('product_id');

        $products = Product::whereIn('id', $dealerProductIds)
            ->where('is_active', true)
            ->paginate(20);

        $prices = DealerProduct::where('dealer_id', $dealer->id)
            ->get()
            ->keyBy('product_id');

        return view('dealer.products.index', compact('products', 'prices'));
    }

    public function show(int $id): View
    {
        $dealer = \App\Models\DealerInformation::where('user_id', auth()->id())->firstOrFail();
        $product = Product::findOrFail($id);
        $price = DealerProduct::where('dealer_id', $dealer->id)
            ->where('product_id', $id)
            ->first();

        return view('dealer.products.show', compact('product', 'price'));
    }
}

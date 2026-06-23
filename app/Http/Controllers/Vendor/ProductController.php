<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\VendorInformation;
use App\Models\VendorProduct;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $vendor = VendorInformation::where('user_id', auth()->id())->firstOrFail();

        $vendorProductIds = VendorProduct::where('vendor_id', $vendor->id)
            ->pluck('product_id');

        $products = Product::whereIn('id', $vendorProductIds)
            ->where('is_active', true)
            ->paginate(20);

        return view('vendor.products.index', compact('products'));
    }

    public function show(int $id): View
    {
        $vendor = VendorInformation::where('user_id', auth()->id())->firstOrFail();
        $product = Product::findOrFail($id);

        $vendorProduct = VendorProduct::where('vendor_id', $vendor->id)
            ->where('product_id', $id)
            ->first();

        return view('vendor.products.show', compact('product', 'vendorProduct'));
    }
}

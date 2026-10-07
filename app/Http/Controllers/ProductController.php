<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a single product.
     */
    public function show(Product $product): View
    {
        // Only active products are publicly visible
        abort_if(!$product->status, 404);

        // Product related data
        $product->load([
            'business',
            'category',
            'subcategory',
            'images',
        ]);

        // Business must also be approved
        abort_if(
            !$product->business ||
            $product->business->status !== 'approved',
            404
        );

        return view(
            'products.show',
            compact('product')
        );
    }
}

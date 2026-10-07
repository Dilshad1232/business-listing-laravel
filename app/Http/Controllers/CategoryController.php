<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Business;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display all active categories.
     */
    public function index()
    {
        $categories = Category::query()
            ->where('status', true)
            ->withCount('subcategories')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(24);

        return view('categories.index', compact('categories'));
    }


    /**
     * Display a single category.
     */
    public function show(Category $category)
    {
        abort_if(!$category->status, 404);

        /*
        |--------------------------------------------------------------------------
        | Subcategories
        |--------------------------------------------------------------------------
        */

        $category->load([
            'subcategories' => function ($query) {
                $query
                    ->where('status', true)
                    ->orderBy('sort_order')
                    ->orderBy('name');
            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | Approved Businesses
        |--------------------------------------------------------------------------
        */

        $businesses = Business::with([
                'category',
                'subcategory',
                'city',
                'state',
            ])
            ->where('status', 'approved')
            ->where('category_id', $category->id)
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Active Products
        |--------------------------------------------------------------------------
        */

        $products = Product::with([
                'business',
                'subcategory',
                'images',
            ])
            ->where('category_id', $category->id)
            ->where('status', true)
            ->whereHas('business', function ($query) {
                $query->where('status', 'approved');
            })
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->latest()
            ->take(8)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Category Counts
        |--------------------------------------------------------------------------
        */

        $businessCount = Business::where('category_id', $category->id)
            ->where('status', 'approved')
            ->count();

        $productCount = Product::where('category_id', $category->id)
            ->where('status', true)
            ->whereHas('business', function ($query) {
                $query->where('status', 'approved');
            })
            ->count();


        return view('categories.show', compact(
            'category',
            'businesses',
            'products',
            'businessCount',
            'productCount'
        ));
    }
}

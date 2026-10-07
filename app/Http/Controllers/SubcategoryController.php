<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Business;

class SubcategoryController extends Controller
{
    public function index(Category $category)
    {
        abort_if(!$category->status, 404);

        $subcategories = $category->subcategories()
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(24);

        return view('subcategories.index', compact(
            'category',
            'subcategories'
        ));
    }


    public function show(
        Category $category,
        Subcategory $subcategory
    ) {
        abort_if(!$category->status, 404);

        abort_if(
            !$subcategory->status ||
            $subcategory->category_id !== $category->id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Get Approved Businesses
        |--------------------------------------------------------------------------
        */

        $listings = Business::with([
            'category',
            'subcategory'
        ])
            ->where('status', 'approved')
            ->where('category_id', $category->id)
            ->where('subcategory_id', $subcategory->id)
            ->latest()
            ->paginate(12);

        return view('subcategories.show', compact(
            'category',
            'subcategory',
            'listings'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display all categories.
     */
    public function index()
    {
        $categories = Category::withCount('subcategories')
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }


    /**
     * Show add category form.
     */
    public function create()
    {
        return view('admin.categories.create');
    }


    /**
     * Store new category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',

            'slug' => 'nullable|string|max:255|unique:categories,slug',

            'icon' => [
                'nullable',
                'file',
                'mimes:svg',
                'max:512',
            ],

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'short_description' => 'nullable|string|max:500',

            'description' => 'nullable|string',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string|max:500',

            'status' => 'nullable|boolean',

            'sort_order' => 'nullable|integer|min:0',
        ]);


        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | SVG ICON
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {

            $validated['icon'] = $request
                ->file('icon')
                ->store('categories/icons', 'public');
        } else {

            $validated['icon'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('categories/images', 'public');
        }


        $validated['status'] = $request->boolean('status');

        $validated['sort_order'] = $validated['sort_order'] ?? 0;


        Category::create($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }


    /**
     * Show edit category form.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    /**
     * Update category.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:categories,slug,' . $category->id,
            ],

            'icon' => [
                'nullable',
                'file',
                'mimes:svg',
                'max:512',
            ],

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'short_description' => 'nullable|string|max:500',

            'description' => 'nullable|string',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string|max:500',

            'status' => 'nullable|boolean',

            'sort_order' => 'nullable|integer|min:0',
        ]);


        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | REPLACE SVG ICON
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {

            // Delete old icon
            if (!empty($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            // Store new icon
            $validated['icon'] = $request
                ->file('icon')
                ->store('categories/icons', 'public');

        } else {

            // Keep existing icon
            unset($validated['icon']);
        }


        /*
        |--------------------------------------------------------------------------
        | REPLACE CATEGORY IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (!empty($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('categories/images', 'public');

        } else {

            unset($validated['image']);
        }


        $validated['status'] = $request->boolean('status');

        $validated['sort_order'] = $validated['sort_order'] ?? 0;


        $category->update($validated);


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }


    /**
     * Delete category.
     */
    public function destroy(Category $category)
    {
        if (!empty($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        if (!empty($category->image)) {
            Storage::disk('public')->delete($category->image);
        }


        $category->delete();


        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}

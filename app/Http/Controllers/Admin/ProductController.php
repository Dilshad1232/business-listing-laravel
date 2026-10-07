<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Display all products
     */
    public function index(Request $request)
    {
        $query = Product::with([
            'business',
            'category',
            'subcategory',
            'images',
        ]);

        // Search
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhereHas('business', function ($businessQuery) use ($search) {
                        $businessQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    });

            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Subcategory filter
        if ($request->filled('subcategory')) {
            $query->where('subcategory_id', $request->subcategory);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Featured filter
        if ($request->filled('featured')) {
            $query->where('is_featured', true);
        }

        // Sorting
        switch ($request->get('sort')) {

            case 'name_az':
                $query->orderBy('name');
                break;

            case 'name_za':
                $query->orderByDesc('name');
                break;

            case 'price_low':
                $query->orderBy('price');
                break;

            case 'price_high':
                $query->orderByDesc('price');
                break;

            case 'oldest':
                $query->oldest();
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query
            ->paginate(15)
            ->withQueryString();

        return view('admin.products.index', compact(
            'products'
        ));
    }


    /**
     * Show create product form
     */
    public function create()
    {
        $businesses = Business::where('status', 'approved')
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact(
            'businesses',
            'categories',
            'subcategories'
        ));
    }


    /**
     * Store product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'nullable',
                'exists:subcategories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,sku',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'stock' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

        ]);

        DB::transaction(function () use ($request, $validated, &$product) {

            $validated['slug'] = $this->generateUniqueSlug(
                $validated['name']
            );

            $validated['status'] = $request->boolean('status');
            $validated['is_featured'] = $request->boolean('is_featured');

            $validated['stock'] = $validated['stock'] ?? 0;
            $validated['sort_order'] = $validated['sort_order'] ?? 0;

            unset($validated['images']);

            $product = Product::create($validated);

            // Upload product images
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $index => $image) {

                    $path = $image->store(
                        'products',
                        'public'
                    );

                    $product->images()->create([
                        'image' => $path,
                        'sort_order' => $index,
                        'is_primary' => $index === 0,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }


    /**
     * Display product details
     */
    public function show(Product $product)
    {
        $product->load([
            'business',
            'category',
            'subcategory',
            'images',
        ]);

        return view('admin.products.show', compact(
            'product'
        ));
    }


    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        $product->load('images');

        $businesses = Business::where('status', 'approved')
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'businesses',
            'categories',
            'subcategories'
        ));
    }


    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([

            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'category_id' => [
                'nullable',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'nullable',
                'exists:subcategories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'sku' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,sku,' . $product->id,
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'stock' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'images' => [
                'nullable',
                'array',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

        ]);

        DB::transaction(function () use ($request, $validated, $product) {

            if ($product->name !== $validated['name']) {

                $validated['slug'] = $this->generateUniqueSlug(
                    $validated['name'],
                    $product->id
                );
            }

            $validated['status'] = $request->boolean('status');
            $validated['is_featured'] = $request->boolean('is_featured');

            $validated['stock'] = $validated['stock'] ?? 0;
            $validated['sort_order'] = $validated['sort_order'] ?? 0;

            unset($validated['images']);

            $product->update($validated);

            // Add new images
            if ($request->hasFile('images')) {

                $lastSortOrder = (int) $product->images()->max(
                    'sort_order'
                );

                foreach ($request->file('images') as $index => $image) {

                    $path = $image->store(
                        'products',
                        'public'
                    );

                    $product->images()->create([
                        'image' => $path,
                        'sort_order' => $lastSortOrder + $index + 1,
                        'is_primary' => false,
                    ]);
                }

                // If no primary image exists
                if (!$product->images()->where('is_primary', true)->exists()) {

                    $firstImage = $product->images()
                        ->orderBy('sort_order')
                        ->first();

                    if ($firstImage) {
                        $firstImage->update([
                            'is_primary' => true,
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function setPrimaryImage(Product $product, ProductImage $image)
    {
        // Make sure image belongs to this product
        abort_unless($image->product_id === $product->id, 404);

        // Remove primary status from all images
        $product->images()->update([
            'is_primary' => false,
        ]);

        // Set selected image as primary
        $image->update([
            'is_primary' => true,
        ]);

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Primary image updated successfully.');
    }


    public function destroyImage(Product $product, ProductImage $image)
    {
        // Make sure image belongs to this product
        abort_unless($image->product_id === $product->id, 404);

        // Delete physical image
        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete database record
        $wasPrimary = $image->is_primary;

        $image->delete();

        // If deleted image was primary,
        // automatically make the first remaining image primary
        if ($wasPrimary) {

            $newPrimary = $product->images()
                ->orderBy('sort_order')
                ->first();

            if ($newPrimary) {

                $newPrimary->update([
                    'is_primary' => true,
                ]);

            }

        }

        return redirect()
            ->route('admin.products.show', $product)
            ->with('success', 'Product image deleted successfully.');
    }
    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        $product->load('images');

        foreach ($product->images as $image) {

            if ($image->image) {
                Storage::disk('public')->delete(
                    $image->image
                );
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }


    /**
     * Generate unique slug
     */
    private function generateUniqueSlug(
        string $name,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($name);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Product::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }
}

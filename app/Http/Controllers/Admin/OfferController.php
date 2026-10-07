<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
class OfferController extends Controller
{
    /**
     * Display a listing of offers.
     */
    public function index(Request $request)
    {
        $query = Offer::with('business');

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('coupon_code', 'like', '%' . $search . '%')
                    ->orWhereHas('business', function ($businessQuery) use ($search) {
                        $businessQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Business filter
        if ($request->filled('business_id')) {
            $query->where('business_id', $request->business_id);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Featured filter
        if ($request->filled('featured')) {
            $query->where(
                'is_featured',
                $request->featured === '1'
            );
        }

        $offers = $query
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $businesses = Business::where('status', 'approved')
            ->orderBy('name')
            ->get();

        return view('admin.offers.index', compact(
            'offers',
            'businesses'
        ));
    }

    /**
     * Show the form for creating a new offer.
     */
    public function create()
    {
        $businesses = Business::where('status', 'approved')
            ->orderBy('name')
            ->get();

        return view('admin.offers.create', compact('businesses'));
    }

    /**
     * Store a newly created offer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:offers,slug',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'discount_type' => [
                'required',
                Rule::in([
                    'percentage',
                    'fixed',
                    'none',
                ]),
            ],

            'discount_value' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'minimum_purchase' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'maximum_discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'coupon_code' => [
                'nullable',
                'string',
                'max:255',
                'unique:offers,coupon_code',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'terms_conditions' => [
                'nullable',
                'string',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']);

        $validated['coupon_code'] = !empty($validated['coupon_code'])
            ? strtoupper(trim($validated['coupon_code']))
            : null;

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->boolean('status');
        if (!empty($validated['starts_at'])) {
            $validated['starts_at'] = Carbon::parse($validated['starts_at'])
                ->startOfDay();
        }

        if (!empty($validated['ends_at'])) {
            $validated['ends_at'] = Carbon::parse($validated['ends_at'])
                ->endOfDay();
        }
        Offer::create($validated);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Offer created successfully.');
    }

    /**
     * Display the specified offer.
     */
    public function show(Offer $offer)
    {
        $offer->load('business');

        return view('admin.offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified offer.
     */
    public function edit(Offer $offer)
    {
        $businesses = Business::where('status', 'approved')
            ->orderBy('name')
            ->get();

        return view('admin.offers.edit', compact(
            'offer',
            'businesses'
        ));
    }

    /**
     * Update the specified offer.
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('offers', 'slug')->ignore($offer->id),
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'discount_type' => [
                'required',
                Rule::in([
                    'percentage',
                    'fixed',
                    'none',
                ]),
            ],

            'discount_value' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'minimum_purchase' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'maximum_discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'coupon_code' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('offers', 'coupon_code')->ignore($offer->id),
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'terms_conditions' => [
                'nullable',
                'string',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['title']);

        $validated['coupon_code'] = !empty($validated['coupon_code'])
            ? strtoupper(trim($validated['coupon_code']))
            : null;

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->boolean('status');
        
        if (!empty($validated['starts_at'])) {
            $validated['starts_at'] = Carbon::parse($validated['starts_at'])
                ->startOfDay();
        }

        if (!empty($validated['ends_at'])) {
            $validated['ends_at'] = Carbon::parse($validated['ends_at'])
                ->endOfDay();
        }
        $offer->update($validated);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Offer updated successfully.');
    }

    /**
     * Remove the specified offer.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Offer deleted successfully.');
    }
}

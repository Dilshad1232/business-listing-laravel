<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessReview;
use Illuminate\Http\Request;

class BusinessReviewController extends Controller
{
    /**
     * Display all business reviews.
     */
    public function index(Request $request)
    {
        $query = BusinessReview::with([
            'business',
            'user',
        ])->latest();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('reviewer_name', 'like', "%{$search}%")
                    ->orWhere('reviewer_email', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%")

                    ->orWhereHas('business', function ($businessQuery) use ($search) {

                        $businessQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Rating Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('rating')) {

            $query->where(
                'rating',
                $request->rating
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Reviews
        |--------------------------------------------------------------------------
        */

        $reviews = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalReviews = BusinessReview::count();

        $pendingReviews = BusinessReview::where(
            'status',
            'pending'
        )->count();

        $approvedReviews = BusinessReview::where(
            'status',
            'approved'
        )->count();

        $rejectedReviews = BusinessReview::where(
            'status',
            'rejected'
        )->count();

        $featuredReviews = BusinessReview::where(
            'is_featured',
            true
        )->count();


        return view(
            'admin.business-reviews.index',
            compact(
                'reviews',
                'totalReviews',
                'pendingReviews',
                'approvedReviews',
                'rejectedReviews',
                'featuredReviews'
            )
        );
    }


    /**
     * Show the form for creating a new review.
     */
    public function create()
    {
        $businesses = Business::orderBy('name')->get([
            'id',
            'name',
        ]);

        return view(
            'admin.business-reviews.create',
            compact('businesses')
        );
    }


    /**
     * Store a newly created review.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'user_id' => [
                'nullable',
                'exists:users,id',
            ],

            'reviewer_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'reviewer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'comment' => [
                'required',
                'string',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'admin_reply' => [
                'nullable',
                'string',
            ],

            'admin_replied_at' => [
                'nullable',
                'date',
            ],

            'helpful_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

        ]);


        $validated['is_featured'] =
            $request->boolean('is_featured');


        $review = BusinessReview::create(
            $validated
        );


        return redirect()
            ->route('admin.reviews.index')
            ->with(
                'success',
                'Review created successfully.'
            );
    }


    /**
     * Display the specified review.
     */
    public function show(BusinessReview $review)
    {
        $review->load([
            'business',
            'user',
        ]);


        return view(
            'admin.business-reviews.show',
            compact('review')
        );
    }


    /**
     * Show the form for editing the specified review.
     */
    public function edit(BusinessReview $review)
    {
        $review->load([
            'business',
            'user',
        ]);

        $businesses = Business::orderBy('name')->get([
            'id',
            'name',
        ]);

        return view(
            'admin.business-reviews.edit',
            compact(
                'review',
                'businesses'
            )
        );
    }


    /**
     * Update the specified review.
     */
    public function update(
        Request $request,
        BusinessReview $review
    ) {

        $validated = $request->validate([

            'business_id' => [
                'required',
                'exists:businesses,id',
            ],

            'user_id' => [
                'nullable',
                'exists:users,id',
            ],

            'reviewer_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'reviewer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'comment' => [
                'required',
                'string',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'admin_reply' => [
                'nullable',
                'string',
            ],

            'admin_replied_at' => [
                'nullable',
                'date',
            ],

            'helpful_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

        ]);


        $validated['is_featured'] =
            $request->boolean('is_featured');


        $review->update(
            $validated
        );


        return redirect()
            ->route('admin.reviews.index')
            ->with(
                'success',
                'Review updated successfully.'
            );
    }

/**
 * Approve the specified review.
 */
public function approve(BusinessReview $review)
{
    $review->update([
        'status' => 'approved',
    ]);

    return redirect()
        ->route('admin.reviews.index')
        ->with('success', 'Review approved successfully.');
}


/**
 * Reject the specified review.
 */
public function reject(BusinessReview $review)
{
    $review->update([
        'status' => 'rejected',
    ]);

    return redirect()
        ->route('admin.reviews.index')
        ->with('success', 'Review rejected successfully.');
}
    /**
     * Remove the specified review.
     */
    public function destroy(BusinessReview $review)
    {
        $review->delete();


        return redirect()
            ->route('admin.reviews.index')
            ->with(
                'success',
                'Review deleted successfully.'
            );
    }
}

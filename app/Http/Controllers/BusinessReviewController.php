<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessReview;
use Illuminate\Http\Request;

class BusinessReviewController extends Controller
{
    /**
     * Store a new public business review.
     */
    public function store(Request $request, Business $business)
    {
        // Only approved businesses can receive reviews
        abort_if($business->status !== 'approved', 404);

        /*
        |--------------------------------------------------------------------------
        | Validate Review
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'reviewer_name' => [
                'required',
                'string',
                'max:100',
            ],

            'reviewer_email' => [
                'required',
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
                'min:5',
                'max:5000',
            ],
        ], [
            'reviewer_name.required' => 'Please enter your name.',

            'reviewer_email.required' => 'Please enter your email.',

            'reviewer_email.email' => 'Please enter a valid email address.',

            'rating.required' => 'Please select a rating.',

            'rating.min' => 'Rating must be between 1 and 5 stars.',

            'rating.max' => 'Rating must be between 1 and 5 stars.',

            'comment.required' => 'Please write your review.',

            'comment.min' => 'Review must contain at least 5 characters.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Review
        |--------------------------------------------------------------------------
        |
        | Logged-in users:
        |    One pending/approved review per business.
        |
        | Guests:
        |    Same email cannot submit another pending/approved review
        |    for the same business.
        |
        */

        if (auth()->check()) {

            $existingReview = BusinessReview::where('business_id', $business->id)
                ->where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'approved'])
                ->first();

        } else {

            $existingReview = BusinessReview::where('business_id', $business->id)
                ->whereNull('user_id')
                ->where('reviewer_email', $validated['reviewer_email'])
                ->whereIn('status', ['pending', 'approved'])
                ->first();
        }

        if ($existingReview) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'You have already submitted a review for this business.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Review
        |--------------------------------------------------------------------------
        */

        BusinessReview::create([

            'business_id' => $business->id,

            'user_id' => auth()->check()
                ? auth()->id()
                : null,

            'reviewer_name' => $validated['reviewer_name'],

            'reviewer_email' => $validated['reviewer_email'],

            'rating' => $validated['rating'],

            'title' => $validated['title'] ?? null,

            'comment' => $validated['comment'],

            // Review will appear publicly only after admin approval
            'status' => 'pending',

            'admin_reply' => null,

            'admin_replied_at' => null,

            'helpful_count' => 0,

            'is_featured' => false,
        ]);

        return back()
            ->with(
                'success',
                'Thank you! Your review has been submitted and is waiting for approval.'
            );
    }
}
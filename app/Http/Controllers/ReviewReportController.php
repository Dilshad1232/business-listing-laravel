<?php

namespace App\Http\Controllers;

use App\Models\BusinessReview;
use App\Models\ReviewReport;
use Illuminate\Http\Request;

class ReviewReportController extends Controller
{
    /**
     * Store a report for a business review.
     */
    public function store(
        Request $request,
        BusinessReview $review
    ) {
        $validated = $request->validate([

            'reason' => [
                'required',
                'string',
                'max:255',
            ],

            'message' => [
                'nullable',
                'string',
                'max:2000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Reporter Information
        |--------------------------------------------------------------------------
        */

        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Create Report
        |--------------------------------------------------------------------------
        */

        ReviewReport::create([

            'review_id' => $review->id,

            'user_id' => $user?->id,

            'reporter_name' => $user?->name,

            'reporter_email' => $user?->email,

            'reason' => $validated['reason'],

            'message' => $validated['message'] ?? null,

            'status' => 'pending',

        ]);


        return back()->with(
            'success',
            'Thank you. Your report has been submitted for review.'
        );
    }
}

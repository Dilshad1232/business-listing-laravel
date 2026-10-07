<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\NotificationService;

class BookingController extends Controller
{
    /**
     * Show booking page.
     */
    public function create(Business $business)
    {
        abort_if(
            $business->status !== 'approved',
            404
        );

        $business->load([
            'category',
            'subcategory',
            'city',
            'state',
            'services',
            'activeOffers',
        ]);

        $offers = $business->activeOffers;

        return view(
            'bookings.create',
            compact(
                'business',
                'offers'
            )
        );
    }


    /**
     * Store booking.
     */
    public function store(
        Request $request,
        Business $business
    ) {
        abort_if(
            $business->status !== 'approved',
            404
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE REQUEST
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'business_service_id' => [
                'required',
                'exists:business_services,id',
            ],

            'offer_id' => [
                'nullable',
                'exists:offers,id',
            ],

            'coupon_code' => [
                'nullable',
                'string',
                'max:100',
            ],

            'customer_name' => [
                'required',
                'string',
                'max:255',
            ],

            'customer_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'customer_phone' => [
                'required',
                'string',
                'max:30',
            ],

            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'booking_time' => [
                'required',
                'date_format:H:i',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET SELECTED SERVICE
        |--------------------------------------------------------------------------
        */

        $service = $business->services()
            ->where(
                'id',
                $validated['business_service_id']
            )
            ->first();


        if (!$service) {

            return back()
                ->withErrors([
                    'business_service_id' =>
                        'Invalid service selected.',
                ])
                ->withInput();

        }


        /*
        |--------------------------------------------------------------------------
        | ORIGINAL SERVICE AMOUNT
        |--------------------------------------------------------------------------
        */

        $originalAmount =
            (float) ($service->price ?? 0);


        /*
        |--------------------------------------------------------------------------
        | DEFAULT VALUES
        |--------------------------------------------------------------------------
        */

        $discountAmount = 0;

        $finalAmount = $originalAmount;

        $offer = null;


        /*
        |--------------------------------------------------------------------------
        | OFFER SELECTED?
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['offer_id'])) {


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT:
            | Get offer only from THIS business.
            |--------------------------------------------------------------------------
            */

            $offer = $business->activeOffers()
                ->where(
                    'id',
                    $validated['offer_id']
                )
                ->first();


            if (!$offer) {

                return back()
                    ->withErrors([
                        'offer_id' =>
                            'The selected offer is not available for this business.',
                    ])
                    ->withInput();

            }


            /*
            |--------------------------------------------------------------------------
            | CHECK OFFER START DATE
            |--------------------------------------------------------------------------
            */

            $now = now();


            if (
                $offer->starts_at &&
                $now->lt($offer->starts_at)
            ) {

                return back()
                    ->withErrors([
                        'offer_id' =>
                            'This offer has not started yet.',
                    ])
                    ->withInput();

            }


            /*
            |--------------------------------------------------------------------------
            | CHECK OFFER END DATE
            |--------------------------------------------------------------------------
            */

            if (
                $offer->ends_at &&
                $now->gt($offer->ends_at)
            ) {

                return back()
                    ->withErrors([
                        'offer_id' =>
                            'This offer has expired.',
                    ])
                    ->withInput();

            }


            /*
            |--------------------------------------------------------------------------
            | MINIMUM PURCHASE
            |--------------------------------------------------------------------------
            */

            $minimumPurchase =
                (float) ($offer->minimum_purchase ?? 0);


            if (
                $minimumPurchase > 0 &&
                $originalAmount < $minimumPurchase
            ) {

                return back()
                    ->withErrors([
                        'offer_id' =>
                            'This offer requires a minimum purchase of ₹' .
                            number_format(
                                $minimumPurchase,
                                2
                            ) .
                            '.',
                    ])
                    ->withInput();

            }


            /*
            |--------------------------------------------------------------------------
            | COUPON REQUIRED?
            |--------------------------------------------------------------------------
            */

            $requiredCoupon =
                trim((string) ($offer->coupon_code ?? ''));


            /*
            |--------------------------------------------------------------------------
            | OFFER HAS COUPON
            |--------------------------------------------------------------------------
            */

            if ($requiredCoupon !== '') {


                /*
                |--------------------------------------------------------------------------
                | USER MUST ENTER COUPON
                |--------------------------------------------------------------------------
                */

                $enteredCoupon =
                    strtoupper(
                        trim(
                            (string) (
                                $validated['coupon_code']
                                ?? ''
                            )
                        )
                    );


                if ($enteredCoupon === '') {

                    return back()
                        ->withErrors([
                            'coupon_code' =>
                                'Please enter the coupon code for this offer.',
                        ])
                        ->withInput();

                }


                /*
                |--------------------------------------------------------------------------
                | CHECK COUPON
                |--------------------------------------------------------------------------
                */

                if (
                    !hash_equals(
                        strtoupper($requiredCoupon),
                        $enteredCoupon
                    )
                ) {

                    return back()
                        ->withErrors([
                            'coupon_code' =>
                                'Invalid coupon code.',
                        ])
                        ->withInput();

                }

            }


            /*
            |--------------------------------------------------------------------------
            | CALCULATE DISCOUNT
            |--------------------------------------------------------------------------
            */

            if ($offer->discount_type === 'percentage') {


                $discountAmount =
                    (
                        $originalAmount
                        *
                        (float) $offer->discount_value
                    )
                    / 100;


                /*
                |--------------------------------------------------------------------------
                | MAXIMUM DISCOUNT
                |--------------------------------------------------------------------------
                */

                $maximumDiscount =
                    (float) (
                        $offer->maximum_discount
                        ?? 0
                    );


                if ($maximumDiscount > 0) {

                    $discountAmount =
                        min(
                            $discountAmount,
                            $maximumDiscount
                        );

                }

            }

            elseif ($offer->discount_type === 'fixed') {

                $discountAmount =
                    (float) (
                        $offer->discount_value
                        ?? 0
                    );

            }

            else {

                $discountAmount = 0;

            }


            /*
            |--------------------------------------------------------------------------
            | DISCOUNT CAN NEVER EXCEED ORIGINAL AMOUNT
            |--------------------------------------------------------------------------
            */

            $discountAmount =
                min(
                    $discountAmount,
                    $originalAmount
                );

        }


        /*
        |--------------------------------------------------------------------------
        | FINAL AMOUNT
        |--------------------------------------------------------------------------
        */

        $finalAmount =
            max(
                0,
                $originalAmount - $discountAmount
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE BOOKING
        |--------------------------------------------------------------------------
        */

        $booking = Booking::create([

            'business_id' =>
                $business->id,

            'user_id' =>
                Auth::id(),

            'business_service_id' =>
                $service->id,

            'offer_id' =>
                $offer?->id,

            'customer_name' =>
                $validated['customer_name'],

            'customer_email' =>
                $validated['customer_email'] ?? null,

            'customer_phone' =>
                $validated['customer_phone'],

            'booking_date' =>
                $validated['booking_date'],

            'booking_time' =>
                $validated['booking_time'],

            'original_amount' =>
                $originalAmount,

            'discount_amount' =>
                $discountAmount,

            'final_amount' =>
                $finalAmount,

            'notes' =>
                $validated['notes'] ?? null,

            'status' =>
                'pending',

        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */
        if ($booking->user_id) {

            // User notification
            NotificationService::create(
                $booking->user_id,
                'Booking Submitted',
                'Your booking request for ' .
                $business->business_name .
                ' has been submitted successfully.',
                'booking',
                route('businesses.show', $business)
            );
        }

        // Admin notification
        NotificationService::create(
            null,
            'New Booking Received',
            'A new booking has been submitted for ' .
            $business->business_name .
            ' by ' .
            $validated['customer_name'] .
            '.',
            'booking',
            route('admin.bookings.show', $booking)
        );
        return back()->with(
            'booking_success',
            'Your appointment request has been submitted successfully.'
        );
    }
}

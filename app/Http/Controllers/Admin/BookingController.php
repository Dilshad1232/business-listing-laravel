<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Providers\NotificationService;
class BookingController extends Controller
{
    /**
     * Display all bookings.
     */
    public function index(Request $request)
    {
        $query = Booking::with([
            'business',
            'user',
            'businessService',
            'offer',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'customer_name',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'customer_email',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'customer_phone',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhereHas('business', function ($businessQuery) use ($search) {

                    $businessQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
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
        | Booking Date Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('booking_date')) {

            $query->whereDate(
                'booking_date',
                $request->booking_date
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort')) {

            case 'oldest':

                $query->orderBy(
                    'created_at',
                    'asc'
                );

                break;


            case 'date_asc':

                $query
                    ->orderBy(
                        'booking_date',
                        'asc'
                    )
                    ->orderBy(
                        'booking_time',
                        'asc'
                    );

                break;


            case 'date_desc':

                $query
                    ->orderBy(
                        'booking_date',
                        'desc'
                    )
                    ->orderBy(
                        'booking_time',
                        'desc'
                    );

                break;


            case 'amount_high':

                $query->orderByDesc(
                    'final_amount'
                );

                break;


            case 'amount_low':

                $query->orderBy(
                    'final_amount',
                    'asc'
                );

                break;


            default:

                $query->latest();

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $bookings = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $stats = [

            'total' =>
                Booking::count(),

            'pending' =>
                Booking::where(
                    'status',
                    'pending'
                )->count(),

            'confirmed' =>
                Booking::where(
                    'status',
                    'confirmed'
                )->count(),

            'completed' =>
                Booking::where(
                    'status',
                    'completed'
                )->count(),

            'cancelled' =>
                Booking::where(
                    'status',
                    'cancelled'
                )->count(),

        ];


        return view(
            'admin.bookings.index',
            compact(
                'bookings',
                'stats'
            )
        );
    }


    /**
     * Show booking details.
     */
    public function show(Booking $booking)
    {
        $booking->load([
            'business',
            'user',
            'businessService',
            'offer',
        ]);


        return view(
            'admin.bookings.show',
            compact('booking')
        );
    }


    /**
     * Update booking.
     *
     * Resource route:
     * PUT/PATCH /admin/bookings/{booking}
     */

public function update(
    Request $request,
    Booking $booking
) {

    $validated = $request->validate([

        'status' => [
            'required',
            'in:pending,confirmed,completed,cancelled',
        ],

        'admin_notes' => [
            'nullable',
            'string',
            'max:5000',
        ],

    ]);


    $oldStatus = $booking->status;
    $oldNotes = $booking->admin_notes;


    $booking->update([

        'status' =>
            $validated['status'],

        'admin_notes' =>
            $validated['admin_notes'] ?? null,

    ]);


    /*
    |--------------------------------------------------------------------------
    | Notify User
    |--------------------------------------------------------------------------
    */

    if ($booking->user_id !== null) {

        $statusChanged =
            $oldStatus !== $booking->status;

        $notesChanged =
            $oldNotes !== $booking->admin_notes;


        if ($statusChanged || $notesChanged) {

            $message = 'Your booking for ' .
                ($booking->business->business_name ?? 'the business') .
                ' has been updated by admin.';


                NotificationService::create(
                    $booking->user_id,
                    'Booking Updated',
                    'Your booking for ' .
                    ($booking->business->business_name ?? 'the business') .
                    ' has been updated by admin.',
                    'booking',
                    route('businesses.show', $booking->business)
                );

        }

    }


    return redirect()
        ->route(
            'admin.bookings.show',
            $booking
        )
        ->with(
            'success',
            'Booking updated successfully.'
        );
}




    /**
     * Delete booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();


        return redirect()
            ->route(
                'admin.bookings.index'
            )
            ->with(
                'success',
                'Booking deleted successfully.'
            );
    }
}

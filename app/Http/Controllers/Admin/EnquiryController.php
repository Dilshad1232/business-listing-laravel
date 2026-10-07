<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EnquiryController extends Controller
{
    /**
     * Display all enquiries.
     */
    public function index(Request $request): View
    {
        $query = Enquiry::with([
            'business',
            'product',
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")

                    ->orWhereHas('product', function ($productQuery) use ($search) {

                        $productQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    })

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
        | Sorting
        |--------------------------------------------------------------------------
        */

        $enquiries = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $stats = [

            'total' => Enquiry::count(),

            'new' => Enquiry::where(
                'status',
                'new'
            )->count(),

            'contacted' => Enquiry::where(
                'status',
                'contacted'
            )->count(),

            'closed' => Enquiry::where(
                'status',
                'closed'
            )->count(),

        ];


        return view(
            'admin.enquiries.index',
            compact(
                'enquiries',
                'stats'
            )
        );
    }


    /**
     * Display a single enquiry.
     */
    public function show(Enquiry $enquiry): View
    {
        $enquiry->load([
            'business',
            'product',
            'user',
        ]);

        return view(
            'admin.enquiries.show',
            compact('enquiry')
        );
    }


    /**
     * Update enquiry status and admin notes.
     */
    public function update(
        Request $request,
        Enquiry $enquiry
    ): RedirectResponse {

        $validated = $request->validate([

            'status' => [
                'required',
                'in:new,contacted,closed',
            ],

            'admin_notes' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        $enquiry->update([

            'status' => $validated['status'],

            'admin_notes' =>
                $validated['admin_notes'] ?? null,

        ]);


        return redirect()
            ->route(
                'admin.enquiries.show',
                $enquiry
            )
            ->with(
                'success',
                'Enquiry updated successfully.'
            );
    }


    /**
     * Delete enquiry.
     */
    public function destroy(
        Enquiry $enquiry
    ): RedirectResponse {

        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with(
                'success',
                'Enquiry deleted successfully.'
            );
    }
}

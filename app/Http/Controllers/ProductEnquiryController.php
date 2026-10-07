<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductEnquiryController extends Controller
{
    /**
     * Store product enquiry.
     */
    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {

        // Product must be active
        abort_if(!$product->status, 404);

        // Business must be approved
        abort_if(
            !$product->business ||
            $product->business->status !== 'approved',
            404
        );

        // Validate enquiry
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ]);

        // Create enquiry
        Enquiry::create([
            'business_id' => $product->business_id,
            'product_id' => $product->id,
            'user_id' => auth()->id(),

            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],

            'status' => 'new',
        ]);

        return redirect()
        ->to(
            route('products.show', $product->slug)
            . '#product-enquiry'
        )
        ->with(
            'enquiry_success',
            'Your enquiry has been sent successfully.'
        );
    }
}

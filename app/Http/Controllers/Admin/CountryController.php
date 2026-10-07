<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * Display all countries.
     */
    public function index(): View
    {
        $countries = Country::orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.countries.index', compact('countries'));
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        return view('admin.countries.create');
    }

    /**
     * Store new country.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:countries,slug'],
            'code' => ['nullable', 'string', 'max:10', 'unique:countries,code'],
            'phone_code' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        Country::create($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country created successfully.');
    }

    /**
     * Display country details.
     */
    public function show(Country $country): View
    {
        return view('admin.countries.show', compact('country'));
    }

    /**
     * Show edit form.
     */
    public function edit(Country $country): View
    {
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update country.
     */
    public function update(
        Request $request,
        Country $country
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:countries,name,' . $country->id,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:countries,slug,' . $country->id,
            ],

            'code' => [
                'nullable',
                'string',
                'max:10',
                'unique:countries,code,' . $country->id,
            ],

            'phone_code' => ['nullable', 'string', 'max:20'],

            'description' => ['nullable', 'string'],

            'status' => ['nullable', 'boolean'],

            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        $country->update($validated);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    /**
     * Delete country.
     */
    public function destroy(Country $country): RedirectResponse
    {
        $country->delete();

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CityController extends Controller
{
    public function index(): View
    {
        $cities = City::with([
            'country',
            'state',
        ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.cities.index', compact('cities'));
    }

    public function create(): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.cities.create', compact(
            'countries',
            'states'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'state_id' => [
                'required',
                'exists:states,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:20',
            ],

            'description' => [
                'nullable',
                'string',
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

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        City::create($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    public function show(City $city): View
    {
        $city->load([
            'country',
            'state',
        ]);

        return view('admin.cities.show', compact('city'));
    }

    public function edit(City $city): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.cities.edit', compact(
            'city',
            'countries',
            'states'
        ));
    }

    public function update(
        Request $request,
        City $city
    ): RedirectResponse {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'exists:countries,id',
            ],

            'state_id' => [
                'required',
                'exists:states,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:20',
            ],

            'description' => [
                'nullable',
                'string',
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

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        $city->update($validated);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    public function destroy(City $city): RedirectResponse
    {
        $city->delete();

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City deleted successfully.');
    }
}

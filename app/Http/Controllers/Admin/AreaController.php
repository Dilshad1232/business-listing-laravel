<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AreaController extends Controller
{
    public function index(): View
    {
        $areas = Area::with([
            'country',
            'state',
            'city',
        ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.areas.index', compact('areas'));
    }

    public function create(): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.areas.create', compact(
            'countries',
            'states',
            'cities'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        Area::create($validated);

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area created successfully.');
    }

    public function show(Area $area): View
    {
        $area->load([
            'country',
            'state',
            'city',
        ]);

        return view('admin.areas.show', compact('area'));
    }

    public function edit(Area $area): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.areas.edit', compact(
            'area',
            'countries',
            'states',
            'cities'
        ));
    }

    public function update(
        Request $request,
        Area $area
    ): RedirectResponse {
        $validated = $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['status'] = $request->boolean('status');

        $area->update($validated);

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area): RedirectResponse
    {
        $area->delete();

        return redirect()
            ->route('admin.areas.index')
            ->with('success', 'Area deleted successfully.');
    }
}

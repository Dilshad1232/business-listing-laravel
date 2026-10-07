<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StateController extends Controller
{
    public function index(): View
    {
        $states = State::with('country')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.states.index', compact('states'));
    }

    public function create(): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.states.create', compact('countries'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'exists:countries,id',
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

        State::create($validated);

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State created successfully.');
    }

    public function show(State $state): View
    {
        $state->load('country');

        return view('admin.states.show', compact('state'));
    }

    public function edit(State $state): View
    {
        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.states.edit', compact(
            'state',
            'countries'
        ));
    }

    public function update(
        Request $request,
        State $state
    ): RedirectResponse {
        $validated = $request->validate([
            'country_id' => [
                'required',
                'exists:countries,id',
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

        $state->update($validated);

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State updated successfully.');
    }

    public function destroy(State $state): RedirectResponse
    {
        $state->delete();

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State deleted successfully.');
    }
}

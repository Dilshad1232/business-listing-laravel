<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    /**
     * Display all sliders.
     */
    public function index()
    {
        $sliders = HomeSlider::orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('admin.home-sliders.index', compact('sliders'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.home-sliders.create');
    }

    /**
     * Store new slider.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'typed_words' => 'nullable|string',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request
                ->file('background_image')
                ->store('home-sliders', 'public');
        }

        $validated['status'] = $request->boolean('status');

        HomeSlider::create($validated);

        return redirect()
            ->route('admin.home-sliders.index')
            ->with('success', 'Slider created successfully.');
    }
    public function show(HomeSlider $homeSlider)
    {
        return view('admin.home-sliders.show', compact('homeSlider'));
    }
    /**
     * Show edit form.
     */
    public function edit(HomeSlider $homeSlider)
    {
        return view('admin.home-sliders.edit', compact('homeSlider'));
    }

    /**
     * Update slider.
     */
    public function update(Request $request, HomeSlider $homeSlider)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'typed_words' => 'nullable|string',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('background_image')) {

            if (
                $homeSlider->background_image &&
                Storage::disk('public')->exists($homeSlider->background_image)
            ) {
                Storage::disk('public')->delete($homeSlider->background_image);
            }

            $validated['background_image'] = $request
                ->file('background_image')
                ->store('home-sliders', 'public');
        }

        $validated['status'] = $request->boolean('status');

        $homeSlider->update($validated);

        return redirect()
            ->route('admin.home-sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    /**
     * Delete slider.
     */
    public function destroy(HomeSlider $homeSlider)
    {
        if (
            $homeSlider->background_image &&
            Storage::disk('public')->exists($homeSlider->background_image)
        ) {
            Storage::disk('public')->delete($homeSlider->background_image);
        }

        $homeSlider->delete();

        return redirect()
            ->route('admin.home-sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }
}

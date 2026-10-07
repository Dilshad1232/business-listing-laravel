<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $settings = WebsiteSetting::first();

        if (!$settings) {
            $settings = WebsiteSetting::create([]);
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = WebsiteSetting::first();

        if (!$settings) {
            $settings = new WebsiteSetting();
        }

        $data = $request->validate([
            'website_name' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',

            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:1000',

            'facebook' => 'nullable|url|max:500',
            'instagram' => 'nullable|url|max:500',
            'youtube' => 'nullable|url|max:500',
            'linkedin' => 'nullable|url|max:500',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',

            'copyright_text' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('logo')) {

            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }

            $data['logo'] = $request->file('logo')
                ->store('website-settings', 'public');
        }

        if ($request->hasFile('favicon')) {

            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }

            $data['favicon'] = $request->file('favicon')
                ->store('website-settings', 'public');
        }

        $settings->fill($data);
        $settings->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Website settings updated successfully.');
    }
}
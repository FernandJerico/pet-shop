<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $meta = SystemInfo::pluck('meta_value', 'meta_field')->toArray();
        return view('dashboard.setting.index', compact('meta'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $metaData = $request->except('_token', 'logo', 'cover');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // delete old logo
            $oldLogo = SystemInfo::where('meta_field', 'logo')->first();
            if ($oldLogo) {
                $oldLogoPath = $oldLogo->meta_value;
                if (Storage::disk('public')->exists($oldLogoPath)) {
                    Storage::disk('public')->delete($oldLogoPath);
                }
            }
            $logoPath = $request->file('logo')->store('system', 'public');
            SystemInfo::updateOrCreate(
                ['meta_field' => 'logo'],
                ['meta_value' => $logoPath]
            );
        }

        // Handle cover upload
        if ($request->hasFile('cover')) {
            // delete old cover
            $oldCover = SystemInfo::where('meta_field', 'cover')->first();
            if ($oldCover) {
                $oldCoverPath = $oldCover->meta_value;
                if (Storage::disk('public')->exists($oldCoverPath)) {
                    Storage::disk('public')->delete($oldCoverPath);
                }
            }
            $coverPath = $request->file('cover')->store('system', 'public');
            SystemInfo::updateOrCreate(
                ['meta_field' => 'cover'],
                ['meta_value' => $coverPath]
            );
        }

        // Update other meta fields
        foreach ($metaData as $field => $value) {
            SystemInfo::updateOrCreate(
                ['meta_field' => $field],
                ['meta_value' => $value]
            );
        }

        return redirect()->route('settings.index')->with('success', 'Meta data updated successfully');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemInfo;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $meta = SystemInfo::pluck('meta_value', 'meta_field')->toArray();
        return view('dashboard.setting.index', compact('meta'));
    }

    public function update(Request $request)
    {
        $metaData = $request->except('_token');
        foreach ($metaData as $field => $value) {
            SystemInfo::where('meta_field', $field)->update(['meta_value' => $value]);
        }
        
        return redirect()->route('settings.index')->with('success', 'Meta data updated successfully');
    }
}
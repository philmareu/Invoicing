<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Invoicing\Models\Setting;

class SettingsController extends Controller
{
    public function get()
    {
        return view('settings.index')
            ->with('settings', Setting::all());
    }
}

<?php

namespace Invoicing\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Invoicing\Http\Controllers\Controller;
use Invoicing\Http\Requests\Settings\UpdateAccountSettingsRequest;

class AccountSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get()
    {
        return view('settings.account')
            ->with('user', Auth::user());
    }

    public function update(UpdateAccountSettingsRequest $request)
    {
        if($request->has('password')) $request->offsetSet('password', bcrypt($request->password));

        Auth::user()->update($request->all());
    }
}

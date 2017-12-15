<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Invoicing\Http\Requests\InstallationRequest;
use Invoicing\User;

class InstallationController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getInstallForm()
    {
        if(User::all()->count()) return redirect('login');

        return view('install');
    }

    public function install(InstallationRequest $request)
    {
        if (User::all()->count()) return redirect('login');

        $request->offsetSet('password', bcrypt($request->password));

        $user = $this->user->create($request->all());

        $user->invoiceSettings()->create($request->all());

        Auth::login($user);

        return redirect('/');
    }
}

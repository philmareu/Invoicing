<?php

namespace Invoicing\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Invoicing\Http\Controllers\Controller;
use Invoicing\Http\Requests\Settings\UpdateInvoiceSettingsRequest;

class InvoiceSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get()
    {
        return view('settings.invoice')
            ->with('settings', $this->getAuthenticatedUser()->invoiceSettings);
    }

    public function update(UpdateInvoiceSettingsRequest $request)
    {
        $this->getAuthenticatedUser()->invoiceSettings()->updateOrCreate(array_merge(
            $request->except('logo'),
            [
                'logo' => $this->extractFilenameFromPath($request->file('logo')->store('logos'))
            ]
        ));
    }

    private function extractFilenameFromPath($path)
    {
        $segments = explode('/', $path);

        return end($segments);
    }
}

<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    protected $fillable = [
        'company',
        'email',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'phone',
        'note'
    ];
}

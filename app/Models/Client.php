<?php

namespace Invoicing\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'title',
        'email',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip',
        'phone'
    ];
}

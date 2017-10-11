<?php

namespace Invoicing;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Invoicing\Models\InvoiceSetting;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rate', 'timezone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get invoice settings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoiceSettings()
    {
        return $this->hasOne(InvoiceSetting::class);
    }
}

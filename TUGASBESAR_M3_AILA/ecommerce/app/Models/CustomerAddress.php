<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'recipient_name', 'phone_number', 'address_label', 'full_address', 'is_primary'];
}
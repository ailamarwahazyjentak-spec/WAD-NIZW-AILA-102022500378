<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'phone_number', 'gender', 'birth_date', 'avatar'];
}

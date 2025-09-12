<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'insurance_type',
        'time_to_call',
        'type',
        'household_size',
        'household_income',
        'gender',
        'dob',
        'address',
        'marital_status',
        'is_self',
        'is_spouse',
        'is_children',
        'children'
    ];
}

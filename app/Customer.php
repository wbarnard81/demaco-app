<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = (['customer', 'colour', 'vat_number', 'company_number']);
}

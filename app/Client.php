<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = (['customer', 'color', 'start_date', 'deadline_date', 'delivery_date', 'boilermaker']);
}

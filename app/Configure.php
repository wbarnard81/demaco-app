<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configure extends Model
{
    protected $fillable = (['fuel', 'electricity', 'provident_fund', 'expected_hours']);
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wages extends Model
{
    protected $fillable = (['quote_id', 'employee', 'employee_rate_per_hour', 'normal_hours', 'overtime_hours', 'doubletime_hours']);

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}

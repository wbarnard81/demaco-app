<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    protected $fillable = (['employee', 'normal_hours', 'overtime_hours', 'doubletime_hours']);

    public function quotes()
    {
        return $this->belongsToMany(Wage::class, 'quote_wages')->withTimestamps();
    }
}

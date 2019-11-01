<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = (['customer', 'color', 'description', 'start_date', 'deadline_date', 'delivery_date']);

    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withTimestamps();
    }
}

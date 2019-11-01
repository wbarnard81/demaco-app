<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = (['first_name', 'last_name', 'rateph']);

    public function jobs()
    {
        return $this->belongsToMany(Job::class)->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = (['first_name', 'last_name', 'rateph']);

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_employee')->withTimestamps();
    }
}

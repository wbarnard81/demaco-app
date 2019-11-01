<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = (['price', 'quantity', 'description']);

    public function quotes()
    {
        return $this->belongsToMany(Quote::class)->withTimestamps();
    }
}

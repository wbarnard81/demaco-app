<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = (['quote_id', 'item_name', 'price', 'quantity']);

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}

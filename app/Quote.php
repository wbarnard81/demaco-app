<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = (['customer', 'petrol_quantity', 'electricity_quantity', 'sow', 'other_expenses', 'consumables', 'quote_total']);

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_quote')->withTimestamps();
    }

    public function wages()
    {
        return $this->belongsToMany(Employee::class, 'quote_wages')->withTimestamps();
    }
}

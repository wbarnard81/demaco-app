<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ([
        'customer', 'petrol_cost_per_litre', 'petrol_quantity', 'electricity_cost_per_unit', 'electricity_quantity',
        'scope_of_work', 'total_expenses', 'total_materials', 'total_wages', 'other_expenses', 'consumables',
        'quote_total_excl', 'quote_tax', 'quote_total'
    ]);

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function wages()
    {
        return $this->hasMany(Wages::class);
    }
}

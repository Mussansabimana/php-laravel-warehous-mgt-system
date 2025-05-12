<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = "exports";
    protected $fillable = ['furniture_id', 'exported_date', 'quantity'];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class, 'furniture_id');
    }
}

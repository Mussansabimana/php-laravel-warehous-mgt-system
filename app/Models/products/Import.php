<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = "imports";
    protected $fillable = ['furniture_id', 'imported_date', 'quantity'];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class, 'furniture_id');
    }
}

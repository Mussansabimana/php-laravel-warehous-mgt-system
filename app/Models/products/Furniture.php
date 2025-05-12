<?php

namespace App\Models\products;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $table = "furnitures";
    protected $fillable = [
        'furniture_ouner',
        'furniture_image',
        'furniture_name',
        'quantity'
    ];

    public function imports()
    {
        return $this->hasMany(Import::class, 'furniture_id');
    }
}

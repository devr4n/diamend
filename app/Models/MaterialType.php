<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tr',
        'name_en',
    ];

    public function materialTypes()
    {
        return $this->belongsToMany(MaterialType::class)->withPivot('material_weight')->withTimestamps();
    }
}

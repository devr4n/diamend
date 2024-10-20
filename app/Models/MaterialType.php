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

    public function getLocalizedNameAttribute()
    {
        return getLang() === 'tr' ? $this->name_tr : $this->name_en;
    }
}

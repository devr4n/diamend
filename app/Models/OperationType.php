<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tr',
        'name_en',
    ];

    public $timestamps = true;

    public function getLocalizedNameAttribute()
    {
        return getLang() === 'tr' ? $this->name_tr : $this->name_en;
    }
}

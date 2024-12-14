<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tr',
        'name_en',
        'description_tr',
        'description_en',
    ];

    public $timestamps =  true;

    public function getLocalizedNameAttribute()
    {
        return getLang() === 'tr' ? $this->name_tr : $this->name_en;
    }
}

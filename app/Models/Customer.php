<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'phone_1',
        'phone_2',
        'address',
    ];

    public function setPhone1Attribute($value)
    {
        $this->attributes['phone_1'] = Crypt::encryptString($value);
    }

    public function getPhone1Attribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setPhone2Attribute($value)
    {
        $this->attributes['phone_2'] = Crypt::encryptString($value);
    }

    public function getPhone2Attribute($value)
    {
        return Crypt::decryptString($value);
    }

}

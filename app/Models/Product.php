<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'operation_type_id',
        'product_type_id',
        'description',
        'weight',
        'image',
        'receive_date',
        'due_date',
        'delivery_date',
        'note',
        'price',
        'material_type_id',
        'material_weight',
        'status_id',
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function operationType(): BelongsTo
    {
        return $this->belongsTo(OperationType::class);
    }

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function materialTypes()
    {
        return $this->belongsToMany(MaterialType::class)->withPivot('material_weight')->withTimestamps();
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('default-image.png');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', // customer id
        'operation_type_id', // [repair, order]
        'product_type_id', // [gold,silver,diamond,imitation,watch,other]
        'description',
        'weight', // product weight gram
        'image,',
        'receive_date', // product received date
        'due_date', // product due date
        'delivery_date', // product delivery date
        'price',
        'note',
        'material_type', // [gold,silver,diamond]
        'material_weight', // material weight gram
        'status', // [pending,completed]
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
}

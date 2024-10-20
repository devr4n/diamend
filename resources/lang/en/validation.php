<?php

return [
    'required' => 'The :attribute field is required.',
    'exists' => 'The selected :attribute is invalid.',
    'product' => [
        'customer_id' => [
            'required' => 'The customer field is required.',
            'exists' => 'The selected customer is invalid.',
        ],
        'operation_type_id' => [
            'required' => 'The operation type field is required.',
            'exists' => 'The selected operation type is invalid.',
        ],
        'product_type_id' => [
            'required' => 'The product type field is required.',
            'exists' => 'The selected product type is invalid.',
        ],
        'price' => 'The price field is required.',
        'quantity' => 'The quantity field is required.',
    ],
    'attributes' => [
        'product.customer_id' => 'Customer',
        'product.operation_type_id' => 'Operation type',
        'product.product_type_id' => 'Product type',
        'product.price' => 'Price',
        'product.quantity' => 'Quantity',
    ],
];

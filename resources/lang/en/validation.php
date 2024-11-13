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

    'customer' => [
        'name' => [
            'required' => 'Name field is required.',
            'max' => 'Name field can be at most :max characters.',
        ],
        'surname' => [
            'required' => 'Surname field is required.',
            'max' => 'Surname field can be at most :max characters.',
        ],
        'phone_1' => [
            'required' => 'Primary phone field is required.',
            'max' => 'Primary phone field can be at most :max characters.',
        ],
        'phone_2' => [
            'required' => 'Secondary phone field is required.',
            'max' => 'Secondary phone field can be at most :max characters.',
        ],
        'address' => [
            'required' => 'Address field is required.',
            'max' => 'Address field can be at most :max characters.',
        ],
    ],


    'attributes' => [
        'product.customer_id' => 'Customer',
        'product.operation_type_id' => 'Operation type',
        'product.product_type_id' => 'Product type',
        'product.price' => 'Price',
        'product.quantity' => 'Quantity',

        'customer.name' => 'Name',
        'customer.surname' => 'Surname',
        'customer.phone' => 'Phone',
        'customer.address' => 'Address',
    ],
];

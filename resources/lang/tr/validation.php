<?php

return [
    'required' => ':attribute alanı zorunludur.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'product' => [
        'customer_id' => [
            'required' => 'Müşteri alanı zorunludur.',
            'exists' => 'Seçilen müşteri geçersiz.',
        ],
        'operation_type_id' => [
            'required' => 'İşlem türü alanı zorunludur.',
            'exists' => 'Seçilen işlem türü geçersiz.',
        ],
        'product_type_id' => [
            'required' => 'Ürün türü alanı zorunludur.',
            'exists' => 'Seçilen ürün türü geçersiz.',
        ],
        'price' => 'Fiyat alanı zorunludur.',
        'quantity' => 'Miktar alanı zorunludur.',
    ],
    'attributes' => [
        'product.customer_id' => 'Müşteri',
        'product.operation_type_id' => 'İşlem tipi',
        'product.product_type_id' => 'Ürün türü',
        'product.price' => 'Fiyat',
        'product.quantity' => 'Miktar',
    ],
];

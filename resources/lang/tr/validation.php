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

    'customer' => [
        'name' => 'Ad alanı zorunludur.',
        'surname' => 'Soyad alanı zorunludur.',
        'phone' => 'Telefon alanı zorunludur.',
        'address' => 'Adres alanı zorunludur.',
    ],


    'attributes' => [
        'product.customer_id' => 'Müşteri',
        'product.operation_type_id' => 'İşlem tipi',
        'product.product_type_id' => 'Ürün türü',
        'product.price' => 'Fiyat',
        'product.quantity' => 'Miktar',

        'customer.name' => 'Ad',
        'customer.surname' => 'Soyad',
        'customer.phone' => 'Telefon',
        'customer.address' => 'Adres',
    ],
];

<?php

return [
    'required' => ':attribute alanı zorunludur.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'uploaded' => ':attribute yüklenemedi.',

    'attributes' => [
        'product.customer_id' => 'Müşteri',
        'product.operation_type_id' => 'İşlem tipi',
        'product.product_type_id' => 'Ürün türü',
        'product.price' => 'Fiyat',
        'product.receive_date' => 'Teslim Alınma Tarihi',
        'product.quantity' => 'Miktar',
        'product.image' => 'Görsel',

        'customer.name' => 'Ad',
        'customer.surname' => 'Soyad',
        'customer.phone' => 'Telefon',
        'customer.address' => 'Adres',
    ],

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
        'receive_date' => 'Teslim Alınma Tarihi alanı zorunludur.',
        'quantity' => 'Miktar alanı zorunludur.',
    ],

    'customer' => [
        'name' => [
            'required' => 'Ad alanı zorunludur.',
            'max' => 'Ad alanı en fazla :max karakter olabilir.',
        ],
        'surname' => [
            'required' => 'Soyad alanı zorunludur.',
            'max' => 'Soyad alanı en fazla :max karakter olabilir.',
        ],
        'phone_1' => [
            'required' => 'Birincil telefon alanı zorunludur.',
            'max' => 'Birincil telefon alanı en fazla :max karakter olabilir.',
        ],
        'phone_2' => [
            'required' => 'İkincil telefon alanı zorunludur.',
            'max' => 'İkincil telefon alanı en fazla :max karakter olabilir.',
        ],
        'address' => [
            'required' => 'Adres alanı zorunludur.',
            'max' => 'Adres alanı en fazla :max karakter olabilir.',
        ],
    ],

];

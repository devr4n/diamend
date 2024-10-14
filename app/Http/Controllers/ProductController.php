<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function data()
    {
        $products = Product::select([
            'id',
            'customer_id',
            'operation_type_id',
            'product_type_id',
            'description',
            'weight',
            'image',
            'receive_date',
            'due_date',
            'delivery_date',
            'price',
            'note',
            'material_type_id',
            'material_weight'
            ,'status_id',
            'created_at'
        ]);
        return datatables()->of($products)
            ->editColumn('customer.name', function ($product) {
                return $product->customer->name;
            })
            ->editColumn('operation_type.name', function ($product) {
                $locale = app()->getLocale();
                return $locale === 'tr' ? $product->operationType->name_tr : $product->operationType->name_en;
            })
            ->editColumn('product_type.name', function ($product) {
                $locale = app()->getLocale();
                return $locale === 'tr' ? $product->productType->name_tr : $product->productType->name_en;
            })
            ->editColumn('created_at', function ($product) {
                return $product->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($customer) {
                return '
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="fas fa-pen"></i></button>
                <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
            ';
            })
            ->make(true);
    }
}

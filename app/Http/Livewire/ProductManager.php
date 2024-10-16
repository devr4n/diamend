<?php

namespace App\Http\Livewire;


use App\Models\Product;
use Livewire\Component;

class ProductManager extends Component
{
    public $mode = 'list';
    public $productId;
    public $products = [];

    protected $listeners = ['setMode'];

    public function setMode($mode, $productId = null)
    {
        $this->mode = $mode;
        $this->productId = $productId;

        if ($mode === 'list') {
            $this->loadProducts();
        }
    }

    public function loadProducts()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product-manager');
    }
}

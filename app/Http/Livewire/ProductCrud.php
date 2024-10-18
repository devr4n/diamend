<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\OperationType;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;

class ProductCrud extends Component
{
    public ?Product $product = null;
    public $entryId = null;
    public $pageTitle = null;
    public $currentPageUrl = null;
    public $mode = 'list';

    public $customers;
    public $operationTypes;
    public $productTypes;

    protected $listeners = ['setMode'];

    public function setMode($mode, $productId = null)
    {
        $this->mode = $mode;
        $this->entryId = $productId;
    }

    public function getEntries()
    {
        $this->customers = Customer::all();
        $this->operationTypes = OperationType::all();
        $this->productTypes = ProductType::all();
    }

    public function render()
    {
        $this->getEntries();
        return view('livewire.product-crud', [
            'customers' => $this->customers,
            'operationTypes' => $this->operationTypes,
            'productTypes' => $this->productTypes,
        ]);
    }
}

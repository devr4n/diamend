<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCrud extends Component
{
    public ?Product $product = null;
    public $entryId = null;
    public $pageTitle = null;
    public $currentPageUrl = null;
    public $mode = 'list';

    protected $listeners = ['setMode'];

    public function setMode($mode, $productId = null)
    {
        $this->mode = $mode;
        $this->entryId = $productId;
    }

    public function render()
    {
        return view('livewire.product-crud');
    }
}

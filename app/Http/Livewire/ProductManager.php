<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductManager extends Component
{
    public $mode = 'list';
    public $productId;
    public $pageTitle;

    public function render()
    {
        $this->pageTitle = $this->getPageTitle();

        return view('livewire.product-manager', [
            'pageTitle' => $this->pageTitle,
        ]);
    }

    private function getPageTitle()
    {
        switch ($this->mode) {
            case 'list':
                return __('general.title.product_list');
            case 'create':
                return __('general.title.add_new_product');
            case 'edit':
                return __('general.title.edit_product');
            default:
                return '';
        }
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }
}

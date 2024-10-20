<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\OperationType;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;
use http\Exception\InvalidArgumentException;

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


    public function setMode($mode = 'list', $productId = null)
    {
        $this->mode = $mode;

        switch ($mode) {
            case 'list':
                $this->product = null;
                $this->entryId = null;
                $this->pageTitle = 'Product List';
                break;

            case  'create':
                $this->product = new Product;
                $this->entryId = null;
                $this->pageTitle = 'Add New Product';

                break;

            case 'edit':
                $this->product = Product::find($productId);

                if ($this->product) {
                    $this->entryId = $this->product->id;
                    $this->pageTitle = 'Edit Product ID : ' . $this->entryId;
                    return $this->redirectRoute('product.edit', ['id' => $this->entryId]);
                } else {
                    $this->emit('recordNotFound', 'Product', $productId);
                    return $this->redirectRoute('product.list');
                }

                break;

            case 'delete':
                $this->delete($productId);
                return;

                default:
                    throw new InvalidArgumentException('Invalid mode : ' . $mode);
                    break;
        }


    }

    public function getEntries()
    {
        $this->customers = Customer::all();
        $this->operationTypes = OperationType::all();
        $this->productTypes = ProductType::all();
    }

    public function save($id = null)
    {
        $this->validate([
            'product.customer_id' => ['required', 'exists:customers,id'],
            'product.operation_type_id' => ['required', 'exists:operation_types,id'],
            'product.product_type_id' => ['required', 'exists:product_types,id'],
            'product.price' => 'required',
            'product.quantity' => 'required',
        ], trans('validation.product'));

        try {



            $this->product->save();
            session()->flash('message', 'Product created successfully');


//            if ($id) {
//                $this->product->save();
//                session()->flash('message', 'Product updated successfully');
//            } else {
//                $this->product->save();
//                session()->flash('message', 'Product created successfully');
//            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the product');
        }
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

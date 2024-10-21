<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerCrud extends Component
{
    public ?Customer $customer = null;
    public $entryId = null;
    public $pageTitle = null;
    public $currentPageUrl = null;
    public $mode = 'list';

    protected $listeners = ['AddEditCustomer'];

    public function AddEditCustomer($mode)
    {
        $this->resetErrorBag();

        switch ($mode) {
            case 'list':
                $this->customer = null;
                $this->entryId = null;
                $this->pageTitle = __('general.title.customer_list');
                $this->currentPageUrl = route('customers.index');
                break;
            case 'create':
                $this->customer = new Customer;
                $this->entryId = null;
                $this->pageTitle = __('general.title.add_new_customer');
                $this->currentPageUrl = route('customers.create');
                break;
            case 'edit':
                $this->customer = Customer::findOrFail($this->entryId);
                $this->pageTitle = __('general.title.edit_customer');
                $this->currentPageUrl = route('customers.edit', $this->entryId);
                break;
            default:
                throw new \InvalidArgumentException('Invalid mode: ' . json_encode($mode));
        }

        $this->mode = $mode;
    }

    public function save()
    {
        $this->validate([
            'customer.name' => 'required|string|max:255',
            'customer.surname' => 'required|string|max:255',
            'customer.phone_1' => 'nullable|string|max:255',
            'customer.phone_2' => 'nullable|string|max:255',
        ]);

        $this->customer->save();

        $this->AddEditCustomer('list');
    }

    public function render()
    {
        return view('livewire.customer-crud');
    }
}

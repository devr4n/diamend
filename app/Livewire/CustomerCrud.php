<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerCrud extends Component
{
    public ?Customer $customer = null;
    public $entryId = null;
    public $pageTitle = null;
    public $currentPageUrl = null;
    public $mode;

    protected $listeners = ['changeViewMode' => 'setMode'];

    public function mount($mode = 'list', ?int $id = null)
    {
        $this->setMode($mode, $id);
    }

    public function setMode($mode = 'list', ?int $id = null)
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
                $this->customer = Customer::findOrFail($id);
                $this->entryId = $id;
                $this->pageTitle = __('general.title.edit_customer');
                $this->currentPageUrl = route('customers.edit', $id);
                break;
            default:
                throw new \InvalidArgumentException('Invalid mode: ' . json_encode($mode));
        }

        $this->mode = $mode;
        $this->dispatch('changeViewMode', [
            'mode' => $this->mode,
            'pageTitle' => $this->pageTitle,
        ]);
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

        $this->setMode('list');
    }

    public function render()
    {
        return view('livewire.customer-crud');
    }
}

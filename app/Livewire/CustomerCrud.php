<?php

namespace App\Livewire;

use Livewire\Component;

class CustomerCrud extends Component
{
    public $mode='list';

    protected $listeners = ['AddEditCustomer' => 'setMode', 'setMode'];

    public function mount($mode = 'list', ?int $id = null)
    {
        $this->setMode($mode, $id);
    }

    public function setMode($mode = 'list', ?int $id = null)
    {
        $this->resetErrorBag();

        switch ($mode) {
            case 'list':
                $this->mode = 'list';
                break;
            case 'add':
                $this->mode = 'add';
                break;
            case 'edit':
                $this->mode = 'edit';
                break;
            default:
                throw new \InvalidArgumentException('Invalid mode');
        }
    }
    public function render()
    {
        return view('livewire.customer-crud');
    }
}

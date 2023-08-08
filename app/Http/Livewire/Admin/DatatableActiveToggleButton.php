<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DatatableActiveToggleButton extends Component
{
    public $item;
    public $active;

    public function mount()
    {
        $this->active = $this->item->active;
    }

    public function setActive()
    {
        $this->item->update(['active' => $this->active]);
    }

    public function render()
    {
        return view('livewire.admin.datatable-active-toggle-button');
    }
}

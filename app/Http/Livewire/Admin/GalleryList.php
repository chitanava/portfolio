<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class GalleryList extends Component
{
    public $galleries = [];

    public function mount()
    {
        $this->galleries = Gallery::orderBy('ord', 'asc')->get();
    }

    public function updateOrder($data)
    {
        foreach($data as $item){
            $gallery = Gallery::findOrFail($item['value']);
            $gallery->ord = $item['order'];
            $gallery->save();
        }

        $this->galleries = Gallery::orderBy('ord', 'asc')->get();
    }

    public function delete($id)
    {
        $this->emit('delete', route('admin.galleries.destroy', $id));
    }

    public function active($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->active = !$gallery->active;
        $gallery->save();
    }

    public function render()
    {
        return view('livewire.admin.gallery-list');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use Livewire\Component;

class AlbumItemsList extends Component
{
    public $gallery;
    public $album;
    public $images = [];

    public function mount()
    {
        $this->images = $this->album->images()->orderBy('ord', 'asc')->get();
    }

    public function updateOrder($data)
    {
        foreach($data as $item){
            $image = Image::findOrFail($item['value']);
            $image->ord = $item['order'];
            $image->save();
        }

        $this->images = $this->album->images()->orderBy('ord', 'asc')->get();
    }

    public function delete($id)
    {
        $this->emit('delete', [
            'action' => route('admin.galleries.albums.images.destroy', [$this->gallery->id, $this->album->id, $id]),
            'title' => 'Are you sure you want to delete the Image?',
            'body' => 'This action will permanently remove image.',
        ]);
    }

    public function active($id)
    {
        $image = Image::findOrFail($id);
        $image->active = !$image->active;
        $image->save();
    }

    public function render()
    {
        return view('livewire.admin.album-items-list');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\ItemsTrait;
use Livewire\Component;
use Illuminate\Support\Str;

class GalleryItemsList extends Component
{
    use ItemsTrait;

    public $gallery;
    public $data = [];

    public function mount()
    {   
        $this->data = $this->concatedData();
    }

    public function updateOrder($data)
    {
        foreach($data as $item){
            list($id, $class) = explode(':',$item['value']);
            $model = $class::findOrFail($id);
            $model->ord = $item['order'];
            $model->save();
        }

        $this->data = $this->concatedData();
    }

    public function delete($id, $class)
    {
        if (Str::endsWith($class, 'Album')) 
        {
            $action = route('admin.galleries.albums.destroy', [$this->gallery->id, $id]);

            $this->emit('delete', [
                'action' => $action,
                'title' => 'Are you sure you want to delete the Album?',
                'body' => 'This action will permanently remove all data, including images and videos, associated with it.',
            ]);
        } 
        elseif (Str::endsWith($class, 'Video'))
        {
            $action = route('admin.galleries.videos.destroy', [$this->gallery->id, $id]);

            $this->emit('delete', [
                'action' => $action,
                'title' => 'Are you sure you want to delete the Video?',
                'body' => 'This action will permanently remove video.',
            ]);
        }
        else 
        {
            $action = route('admin.galleries.images.destroy', [$this->gallery->id, $id]);

            $this->emit('delete', [
                'action' => $action,
                'title' => 'Are you sure you want to delete the Image?',
                'body' => 'This action will permanently remove image.',
            ]);
        }

        $this->data = $this->concatedData();
    }

    public function active($id, $class)
    {
        $model = $class::findOrFail($id);
        $model->active = !$model->active;
        $model->save();

        $this->data = $this->concatedData();
    }

    protected function concatedData()
    {
        return $this->galleryItems($this->gallery, false);
    }

    public function render()
    {
        return view('livewire.admin.gallery-items-list');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;

class AlbumImageList extends Component
{
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
        $action = Str::endsWith($class, 'Album') ?
            route('admin.galleries.albums.destroy', [$this->gallery->id, $id]) : 
            route('admin.galleries.albums.images.destroy', [$this->gallery->id, $id]);

        $this->emit('delete', [
            'action' => $action,
            'title' => 'Are you sure you want to delete the Album?',
            'body' => 'This action will permanently remove all data, including images, associated with it.',
        ]);
    }

    public function active($id, $class)
    {
        $model = $class::findOrFail($id);
        $model->active = !$model->active;
        $model->save();
    }

    protected function concatedData()
    {
        $albums = $this->gallery
                    ->albums()
                    ->orderBy('ord', 'asc')
                    ->get();

        $images = $this->gallery
                    ->images()
                    ->orderBy('ord', 'asc')
                    ->get();

        $concated = $albums->concat($images)
                        ->sortBy('ord')
                        ->values()
                        ->toArray();
        
        return collect($concated);
    }

    public function render()
    {
        return view('livewire.admin.album-image-list');
    }
}

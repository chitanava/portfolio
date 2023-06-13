<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use Livewire\Component;
use Illuminate\Support\Str;

class AlbumItemsList extends Component
{
    public $gallery;
    public $album;
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
        if (Str::endsWith($class, 'Video')) 
        {
            $action = route('admin.galleries.albums.videos.destroy', [$this->gallery->id, $this->album->id, $id]);

            $this->emit('delete', [
                'action' => $action,
                'title' => 'Are you sure you want to delete the Video?',
                'body' => 'This action will permanently remove video.',
            ]);
        } 
        else 
        {
            $action = route('admin.galleries.albums.images.destroy', [$this->gallery->id, $this->album->id, $id]);

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
        $images = $this->album
                    ->images()
                    ->orderBy('ord', 'asc')
                    ->get();

        $videos = $this->album
                    ->videos()
                    ->orderBy('ord', 'asc')
                    ->get();

        $concated = $images
                        ->concat($videos)
                        ->sortBy('ord')
                        ->values();
        
        return collect($concated);
    }

    public function render()
    {
        return view('livewire.admin.album-items-list');
    }
}

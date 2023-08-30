<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\ItemsTrait;
use App\Models\Image;
use Livewire\Component;
use Illuminate\Support\Str;

class AlbumItemsList extends Component
{
    use ItemsTrait;

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
        return $this->albumItems($this->album, false);
    }

    public function render()
    {
        return view('livewire.admin.album-items-list');
    }
}

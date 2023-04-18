<?php

namespace App\Http\Livewire;

// use App\Models\Album;
use App\Models\Gallery;
use Livewire\Component;

class Sort extends Component
{
    public $tasks = [];
    // public $tasks = [
    //     ["id" => 1,
    //     "created_at" => "2023-04-17T21:45:50.000000Z",
    //     "updated_at" => "2023-04-17T23:49:50.000000Z",
    //     "title" => "image 1",
    //     "body" => null,
    //     "ord" => 5,
    //     "imageable_type" => "App\Models\Gallery",
    //     "imageable_id" => 1,
    //     "model" => "App\Models\Image"],
    //     ["id" => 3,
    //     "created_at" => "2023-04-17T21:45:31.000000Z",
    //     "updated_at" => "2023-04-17T23:49:42.000000Z",
    //     "title" => "album 3",
    //     "body" => null,
    //     "ord" => 1,
    //     "gallery_id" => 1,
    //     "model" => "App\Models\Album"],
    //     ["id" => 2,
    //     "created_at" => "2023-04-17T21:45:29.000000Z",
    //     "updated_at" => "2023-04-17T23:49:42.000000Z",
    //     "title" => "album 2",
    //     "body" => null,
    //     "ord" => 2,
    //     "gallery_id" => 1,
    //     "model" => "App\Models\Album"],
    //     ["id" => 2,
    //     "created_at" => "2023-04-17T21:45:53.000000Z",
    //     "updated_at" => "2023-04-17T23:49:55.000000Z",
    //     "title" => "image 2",
    //     "body" => null,
    //     "ord" => 3,
    //     "imageable_type" => "App\Models\Gallery",
    //     "imageable_id" => 1,
    //     "model" => "App\Models\Image"],
    //     ["id" => 1,
    //     "created_at" => "2023-04-17T21:45:26.000000Z",
    //     "updated_at" => "2023-04-17T23:49:55.000000Z",
    //     "title" => "album 1",
    //     "body" => null,
    //     "ord" => 4,
    //     "gallery_id" => 1,
    //     "model" => "App\Models\Album"],
    // ];

    public function updateTaskOrder($data)
    {
        // dd($data);

        foreach($data as $item){
            list($id, $model) = explode(':',$item['value']);
            // dd($foo);
            // dd(Album::find($item['value']));
            $album = $model::find($id);
            $album->ord = $item['order'];
            $album->save();
        }

        $gallery = Gallery::find(1);
        $albums = $gallery->albums()->orderBy('ord', 'asc')->get();
        $images = $gallery->images()->orderBy('ord', 'asc')->get();
        // $images = [];
    
        $merged = $albums->concat($images)->sortBy('ord')->values()->toArray();

        $this->tasks = $merged;
        
    }

    public function mount(){
        $gallery = Gallery::find(1);
        $albums = $gallery->albums()->orderBy('ord', 'asc')->get();
        $images = $gallery->images()->orderBy('ord', 'asc')->get();
        // $images = [];
    
        $merged = $albums->concat($images)->sortBy('ord')->values()->toArray();

        $this->tasks = $merged;

        // dd($this->tasks);

        // dd($this->tasks);
    }

    public function render()
    {
        return view('livewire.sort');
    }
}

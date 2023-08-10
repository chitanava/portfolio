<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Collection;

class PostTags extends Component
{
    public Collection $tags;
    public $inputTag;

    public function mount()
    {
        $this->fill([
            'tags' => collect([])
        ]);
    }

    public function addTag(string $tag)
    {
        if (!($this->tags->contains(function (array $value, int $key) use ($tag) {
            return $value['name'] === $tag;
        }))) {
            $this->tags->push(['name' => $tag]);
            $this->reset('inputTag');
        }
    }

    public function removeTag(string $tag)
    {
        $filtered = $this->tags->reject(function (array $value, int $key) use ($tag) {
            return $value['name'] === $tag;
        });

        $this->tags = $filtered;
    }

    public function render()
    {
        return view('livewire.admin.post-tags');
    }
}

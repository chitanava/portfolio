<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Collection;

class PostTags extends Component
{
    public Collection $tags;
    public $inputTag;
    public $postTags;
    public Collection $suggestions;

    public function mount()
    {
        $this->fill([
            'tags' => collect($this->postTags ? $this->postTags : []),
            'suggestions' => collect()
        ]);
    }

    public function updatedInputTag(string $tag)
    {
        if (\Illuminate\Support\Str::length($tag) > 1) {
            $this->suggestions = \Spatie\Tags\Tag::containing($tag)->get();
        } else {
            $this->suggestions = collect();
        }
    }

    public function addTag(string $tag)
    {
        if (!empty($tag)) {
            if (!($this->tags->contains(function (array $value, int $key) use ($tag) {
                return $value['name'] === $tag;
            }))) {
                $this->tags->push(['name' => $tag]);
                $this->reset('inputTag');
                $this->suggestions = collect();

                $this->emit('inputTagAutoFocus');
            }
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

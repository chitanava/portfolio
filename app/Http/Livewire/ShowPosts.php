<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ShowPosts extends Component
{
    use WithPagination;

    public $searchKey;
    public $search;
    public $tagsData;
    public $tags = [];
    public $perPage = 1;
    public $showLoadMore = true;

    protected $queryString = ['search', 'tags'];

    protected $rules = [
        'searchKey' => 'required|min:3|string',
    ];

    public function mount()
    {
        $this->tagsData = \App\Models\Tag::whereHas('posts', function (Builder $query) {
            $query->isActive()->isPublished();
        })->get();

        $this->searchKey = $this->search;
    }

    public function loadMore()
    {
        $this->perPage += 1;
    }

    public function search()
    {
        $this->validate();
        $this->search = $this->searchKey;
        $this->reset('perPage');
    }

    public function resetSearch()
    {
        $this->search = null;
        $this->reset('searchKey');
        $this->resetErrorBag();
    }

    public function updatedTags()
    {
        $this->tags = collect($this->tags)->reject(function (string|null $value) {
            return is_null($value);
        })->toArray();

        $this->reset('perPage');
    }

    public function render()
    {
        $posts = Post::with('media')
            ->IsActive()
            ->isPublished()
            ->when($this->tags, function (Builder $query) {
                return $query->withAnyTags($this->tags);
            })
            ->when($this->search, function (Builder $query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate($this->perPage);

        if ($posts->total() <= $this->perPage)
            $this->showLoadMore = false;
        else
            $this->showLoadMore = true;

        return view('livewire.show-posts', [
            'posts' => $posts,
        ]);
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SocialLink;
use Illuminate\Support\Collection;

class SocialLinks extends Component
{
    public Collection $inputs;

    protected $rules = [
        'inputs.*.url' => 'required_with:inputs.*.icon_slug|url',
        'inputs.*.icon_slug' => 'required_with:inputs.*.url',
    ];

    protected $messages = [
        'inputs.*.url.required_with' => 'This url field is required.', 
        'inputs.*.url.url' => 'This url field must be a valid URL.', 
        'inputs.*.icon_slug.required_with' => 'This icon slug field is required.', 
    ];

    public function mount()
    {
        $this->setInputs();
    }

    public function addInput()
    {
        $this->inputs->push(['url' => '', 'icon_slug' => '']);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);

        if ($this->inputs->count() == 0) {
            $this->fill([
                'inputs' => collect([['url' => '', 'icon_slug' => '']])
            ]);
        }
    }

    public function submit()
    { 
        $this->validate();

        SocialLink::query()->delete();

        foreach ($this->inputs as $input) {
            if ($input['url'] && $input['icon_slug']) {
                SocialLink::create($input);
            } 
        }

        $this->setInputs();

        $this->dispatchBrowserEvent('lwStatusMessage', 'Social links updated.');
    }

    private function setInputs()
    {
        $links = collect(SocialLink::query()->get(['url', 'icon_slug'])->toArray());

        if ($links->isNotEmpty()) {
            $this->inputs = $links;
        } else {
            $this->fill([
                'inputs' => collect([['url' => '', 'icon_slug' => '']])
            ]);
        }

        return $this->inputs;
    }

    public function render()
    {
        return view('livewire.admin.social-links');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class RetrieveAnalyticsData extends Component
{
    public $analyticsDays = 7;
    public $readyToLoad = false;
    public $fields;
    public $message;
    
    public $method;
    public $title;
    public $forHumans = [];
    public $centerFields = ['activeUsers', 'screenPageViews', 'date'];

    public function loadAnalyticsData()
    {
        $this->readyToLoad = true;
    }

    public function fetchData()
    {
      try {
        $data = \Spatie\Analytics\Facades\Analytics::{$this->method}(\Spatie\Analytics\Period::days($this->analyticsDays));
        
        if(!count($data)) 
            $this->message = 'No data was found.';
        else 
        $this->fields = collect($data[0])->keys();

        $this->emit('dataIsFetched');
        
        return $data;
      } catch (\Throwable $th) {
        $this->message = $th->getMessage();
        return [];
      }
    }

    public function render()
    {
        return view('livewire.admin.retrieve-analytics-data', [
            'data' => $this->readyToLoad
              ? $this->fetchData()
              : [],
          ]);
    }
}

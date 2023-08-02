<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class RetrieveAnalyticsDataExportDropdown extends Component
{
    public $data;
    public $method;
    public $title;

    protected function getListeners()
    {
        return [
            "updateExportData{$this->method}" => 'updateExportData'
        ];
    }

    public function updateExportData($data)
    {
        $this->data = $data;
    }

    public function export()
    {
        return (new \App\Exports\AnalyticsExport($this->data))
            ->download(\Illuminate\Support\Str::slug($this->title).'-'.\Carbon\Carbon::now()->format('d-M-Y').'.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.retrieve-analytics-data-export-dropdown');
    }
}

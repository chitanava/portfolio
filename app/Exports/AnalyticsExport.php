<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class AnalyticsExport implements FromView
{
    use Exportable;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.analytics', [
            'data' => $this->data,
            'fields' => collect($this->data[0])->keys(),
        ]);
    }
}
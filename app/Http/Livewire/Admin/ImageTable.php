<?php

namespace App\Http\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Image;

class ImageTable extends DataTableComponent
{
    protected $model = Image::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // $this->setPerPageAccepted([1]);
        // $this->setPerPage(1);
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setSortingPillsStatus(false);
        // $this->setPaginationMethod('simple');

        $this->setTableWrapperAttributes([
            'default' => false,
          ]);

        $this->setTableAttributes([
            'class' => 'table w-full',
            'default' => false
        ]);

        $this->setTheadAttributes([
            'default' => false,
          ]);
        
          $this->setTbodyAttributes([
            'default' => false,
          ]);

          $this->setThAttributes(function(Column $column) {
         
            return ['default' => false];
          });

          $this->setThSortButtonAttributes(function(Column $column) {

         
            return [
                'class' => 'text-xs font-bold uppercase flex items-center gap-2',
                'default' => false
            ];
          });

          $this->setTrAttributes(function($row, $index) {
            return ['default' => false];
        });

        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            return ['default' => false];
          });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            // Column::make("Caption", "caption")
            //     ->sortable(),
            // Column::make("Active", "active")
            //     ->sortable(),
            // Column::make("Image", "image")
            //     ->sortable(),
            // Column::make("Created at", "created_at")
            //     ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
        ];
    }
}

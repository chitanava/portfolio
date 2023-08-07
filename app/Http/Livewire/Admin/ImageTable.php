<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Support\Facades\DB;

class ImageTable extends DataTableComponent
{
    protected $model = Image::class;

    protected $i = 0;

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

          // $this->setThAttributes(function(Column $column) {
         
          //   return ['default' => false];
          // });

          $this->setThSortButtonAttributes(function(Column $column) {

         
            return [
                'class' => 'text-xs font-bold uppercase flex items-center gap-2',
                'default' => false
            ];
          });

          $this->setTrAttributes(function($row, $index) {
            return ['default' => false];
        });

        // $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
        //     return ['default' => false];
        //   });

          $this->setThAttributes(function(Column $column) {
            if ($column->isField('id')) {
              return [
                'class' => 'text-center',
                'default' => false
              ];
            }
            // if ($column->isField('title')) {
            //   return [
            //     'class' => 'w-full',
            //     'default' => false
            //   ];
            // }
         
            return ['default' => false];
          });

          $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex === 3 ) {
              return [
                'class' => 'text-center',
                'default' => false
              ];
            } 

            if ($columnIndex === 0 ) {
              return [
                'class' => 'font-bold',
                'default' => false
              ];
            } 

            return ['default' => false];
          });    
    }

    public function columns(): array
    {
        return [
            // Column::make("Id", "id")
            //     ->sortable(),
            Column::make('')
    ->label(
        function($row, Column $column) {
          // dd($this);
          $this->i++;
          return $this->i + (($this->page - 1) * $this->perPage);
        }
    ),

            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Crated at", "created_at")
            ->format(
              fn($value, $row, Column $column) => $value->diffForHumans()
          )
                ->sortable(),

                Column::make("Actions", "id")
                ->format(function ($value) {
                    return view('components.admin.dynamic-table-dropdown')
                        ->with('attributes', new \Illuminate\View\ComponentAttributeBag([
                            'id' => $value,
                        ]));
                }),
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

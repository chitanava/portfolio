<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;
    protected $rowIndex = 0;

    protected $listeners = ['deletePost'];

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $this->dispatchBrowserEvent('lwStatusMessage', 'Post deleted.');
    }

    public function delete($id)
    {
        $this->emit('delete', [
            'action' => json_encode(['action' => 'deletePost', 'id' => $id]),
            'title' => 'Are you sure you want to delete the Post?',
        ]);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setSortingPillsStatus(false);
        $this->setDefaultSort('id', 'desc');

        // $this->setPerPageAccepted([2]);
        // $this->setPerPage(2);

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

        $this->setThSortButtonAttributes(function (Column $column) {
            return [
                'class' => 'text-xs font-bold uppercase flex items-center gap-2',
                'default' => false
            ];
        });

        $this->setTrAttributes(function ($row, $index) {
            return ['default' => false];
        });

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                    'default' => false
                ];
            }

            return ['default' => false];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex === 4) {
                return [
                    'class' => 'text-center',
                    'default' => false
                ];
            }

            if ($columnIndex === 0) {
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
            Column::make('')
                ->label(
                    function ($row, Column $column) {
                        $this->rowIndex++;
                        return $this->rowIndex + (($this->page - 1) * $this->perPage);
                    }
                ),
            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Crated at", "created_at")
                ->format(
                    fn ($value, $row, Column $column) => $value->format('d.m.Y, H:i')
                )
                ->sortable(),
            Column::make("published at", "published_at")
                ->format(
                    fn ($value, $row, Column $column) => $value->format('d.m.Y, H:i')
                )
                ->sortable(),
            Column::make("Actions", "id")
                ->format(function ($value) {
                    return view('components.admin.dynamic-table-dropdown')
                        ->with('attributes', new \Illuminate\View\ComponentAttributeBag([
                            'id' => $value,
                        ]));
                }),

        ];
    }
}

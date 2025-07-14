<?php

namespace App\DataTables;

use App\Models\PlnMember;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PlnMemberDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $btnEdit = "<a href='". route('pln-members.edit', $query->id) ."' class='btn btn-warning'>Edit</a>";
                $btnDelete = "<a href='". route('pln-members.destroy', $query->id) ."' class='btn btn-delete btn-danger'>Hapus</a>";
                return "{$btnEdit} {$btnDelete}";
            })
            ->setRowId('id');
    }

    public function query(PlnMember $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pln-members-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('#')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->width(100),

            Column::make('nama'),
            Column::make('nip'),
            Column::make('email'),
            Column::make('jabatan'),
            Column::make('no_hp'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'PlnMembers_' . date('YmdHis');
    }
}

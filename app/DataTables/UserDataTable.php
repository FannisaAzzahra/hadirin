<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($user) {
                // Tombol Edit - Mengubah btn-info menjadi btn-warning
                $btnEdit = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-warning btn-sm me-1">Edit</a>';

                // Tombol Hapus
                $btnDelete = '
                    <form action="' . route('users.destroy', $user->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus user ini?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>';

                return $btnEdit . $btnDelete;
            })
            ->setRowId('id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive(true) // Memastikan tabel responsif
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('#')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->width(50),
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Email'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(150)
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
<?php

namespace App\DataTables;

use App\Models\Presence;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PresenceDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        \Carbon\Carbon::setLocale('id');

        return (new EloquentDataTable($query))
            ->addColumn('tgl', fn($query) => \Carbon\Carbon::parse($query->tgl_kegiatan)->translatedFormat('d F Y'))
            ->addColumn('waktu_mulai', fn($query) => \Carbon\Carbon::parse($query->tgl_kegiatan)->translatedFormat('H:i') . ' WIB')
            ->addColumn('lokasi', fn($query) => $query->lokasi)
            ->addColumn('link_lokasi', function($query) {
                return $query->link_lokasi
                    ? '<a href="'.e($query->link_lokasi).'" target="_blank" style="color:blue; text-decoration:underline;">Klik di sini</a>'
                    : '-';
            })
            ->addColumn('status', function($query) {
                if (!$query->is_active) {
                    return '<span class="badge bg-danger">Nonaktif</span>';
                }
                if ($query->batas_waktu && now()->gt($query->batas_waktu)) {
                    return '<span class="badge bg-warning">Kadaluarsa</span>';
                }
                return '<span class="badge bg-success">Aktif</span>';
            })
            ->addColumn('action', function($query) {
                $btnDetail = "<a href='". route('presence.show', $query->id) ."' class='btn btn-sm btn-secondary me-1'>Detail</a>";
                $btnEdit = "<a href='". route('presence.edit', $query->id) ."' class='btn btn-sm btn-warning me-1'>Edit</a>";
                $btnDelete = "<a href='". route('presence.destroy', $query->id) ."' class='btn btn-sm btn-danger btn-delete'>Hapus</a>";

                return "{$btnDetail}{$btnEdit}{$btnDelete}";
            })
            ->rawColumns(['link_lokasi', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Presence $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('presence-table')
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
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('status')
                ->title('No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->width(50),

            Column::make('nama_kegiatan')
                ->title('Nama Kegiatan')
                ->width(200),

            Column::make('tgl')
                ->title('Tanggal')
                ->width(120),

            Column::make('waktu_mulai')
                ->title('Waktu Mulai')
                ->width(120),

            Column::make('lokasi')
                ->title('Lokasi')
                ->width(180),

            Column::make('link_lokasi')
                ->title('Link Lokasi')
                ->width(120),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(240) // cukup untuk 3 tombol kecil
                ->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Presence_' . date('YmdHis');
    }
}

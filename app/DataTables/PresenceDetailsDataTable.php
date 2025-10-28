<?php

namespace App\DataTables;

use App\Models\PresenceDetail;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PresenceDetailsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('created_at', function ($query) {
                return date('d-m-Y H:i:s', strtotime($query->created_at));
            })
            ->addColumn('signature', function ($query) {
                if (!$query->signature) {
                    return '-';
                }
                $url = Storage::disk('public')->exists($query->signature)
                    ? Storage::url($query->signature)
                    : asset('uploads/' . $query->signature);
                return "<img width='100' src='" . $url . "'>";
            })
            ->addColumn('action', function ($query) {
                return "<a href='" . route('presence-detail.destroy', $query->id) . "' class='btn btn-delete btn-danger btn-sm'>Hapus</a>";
            })
            ->filterColumn('unit', function($query, $keyword) {
                $query->where('unit', 'like', "%{$keyword}%");
            })
            ->filterColumn('unit_dtl', function($query, $keyword) {
                $query->where('unit_dtl', 'like', "%{$keyword}%");
            })
            ->rawColumns(['signature', 'action'])
            ->setRowId('id');
    }

    public function query(PresenceDetail $model): QueryBuilder
    {
        $presenceId = request()->segment(2);
        return $model->where('presence_id', $presenceId)->orderBy('created_at', 'desc');
    }

    public function html(): HtmlBuilder
    {
        // Get companies data for filter dropdown
        $companies = Company::with('activeUnits')->get();
        
        return $this->builder()
            ->setTableId('presencedetails-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('
                <"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>
                <"row"<"col-sm-12"<"filter-section">>>
                <"row"<"col-sm-12"tr>>
                <"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>
            ')
            ->orderBy(1, 'desc')
            ->responsive(true)
            ->selectStyleSingle()
            ->pageLength(25)
            ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]])
            ->buttons([
                Button::make('excel')->text('Export Excel'),
                Button::make('csv')->text('Export CSV'),
                Button::make('pdf')->text('Export PDF'),
                Button::make('print')->text('Print'),
                Button::make('reset')->text('Reset'),
                Button::make('reload')->text('Reload')
            ])
            ->parameters([
                'processing' => true,
                'serverSide' => true,
                'language' => [
                    'processing' => '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>',
                    'lengthMenu' => 'Show _MENU_ entries',
                    'zeroRecords' => 'No matching records found',
                    'info' => 'Showing _START_ to _END_ of _TOTAL_ entries',
                    'infoEmpty' => 'Showing 0 to 0 of 0 entries',
                    'infoFiltered' => '(filtered from _MAX_ total entries)',
                    'search' => 'Search:',
                    'paginate' => [
                        'first' => 'First',
                        'last' => 'Last',
                        'next' => 'Next',
                        'previous' => 'Previous'
                    ],
                    'emptyTable' => 'No data available in table',
                ],
                'initComplete' => 'function() {
                    var api = this.api();
                    var companies = ' . json_encode($companies) . ';
                    
                    // Create simple filter section without card
                    var filterHtml = `
                        <div class="row mb-4 mt-3">
                            <div class="col-md-4 mb-2">
                                <select id="filter-unit" class="form-select">
                                    <option value="">-- Semua Perusahaan --</option>`;
                    
                    companies.forEach(function(company) {
                        filterHtml += `<option value="${company.name}">${company.name}</option>`;
                    });
                    
                    filterHtml += `</select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div id="unit-dtl-container">
                                    <select id="filter-unit-dtl-select" class="form-select d-none">
                                        <option value="">-- Semua Unit --</option>
                                    </select>
                                    <input type="text" id="filter-unit-dtl-input" class="form-control d-none" placeholder="Cari unit detail...">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <button type="button" id="reset-filters" class="btn btn-outline-secondary me-2">Reset</button>
                                <button type="button" id="apply-filters" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    `;
                    
                    $(".filter-section").html(filterHtml);
                    
                    // Company filter change handler
                    $("#filter-unit").on("change", function() {
                        var selectedCompany = $(this).val();
                        var company = companies.find(c => c.name === selectedCompany);
                        var selectElement = $("#filter-unit-dtl-select");
                        var inputElement = $("#filter-unit-dtl-input");
                        
                        // Clear unit detail
                        selectElement.empty().append("<option value=\"\">-- Semua Unit --</option>");
                        inputElement.val("");
                        
                        if (company && company.active_units && company.active_units.length > 0) {
                            // Show dropdown for predefined units
                            company.active_units.forEach(function(unit) {
                                selectElement.append(`<option value="${unit.name}">${unit.name}</option>`);
                            });
                            selectElement.removeClass("d-none");
                            inputElement.addClass("d-none");
                        } else if (selectedCompany) {
                            // Show input for free text
                            selectElement.addClass("d-none");
                            inputElement.removeClass("d-none");
                        } else {
                            // Hide both when no company selected
                            selectElement.addClass("d-none");
                            inputElement.addClass("d-none");
                        }
                    });
                    
                    // Apply filters
                    $("#apply-filters").on("click", function() {
                        var unitFilter = $("#filter-unit").val();
                        var unitDtlFilter = $("#filter-unit-dtl-select").is(":visible") 
                            ? $("#filter-unit-dtl-select").val() 
                            : $("#filter-unit-dtl-input").val();
                        
                        // Apply column filters
                        api.column(4).search(unitFilter);
                        api.column(5).search(unitDtlFilter);
                        api.draw();
                    });
                    
                    // Reset filters
                    $("#reset-filters").on("click", function() {
                        $("#filter-unit").val("");
                        $("#filter-unit-dtl-select").val("").addClass("d-none");
                        $("#filter-unit-dtl-input").val("").addClass("d-none");
                        
                        api.columns().search("");
                        api.draw();
                    });
                    
                    // Filter on Enter key
                    $("#filter-unit-dtl-input").on("keypress", function(e) {
                        if (e.which == 13) {
                            $("#apply-filters").click();
                        }
                    });
                }'
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->width(50)
                ->className('dt-center')
                ->orderable(false)
                ->searchable(false),
            Column::make('created_at')
                ->title('Waktu Absen')
                ->className('dt-center')
                ->width(150),
            Column::make('nama')
                ->title('Nama')
                ->className('dt-left'),
            Column::make('no_hp')
                ->title('No. HP')
                ->className('dt-center')
                ->width(120),
            Column::make('unit')
                ->title('Nama Perusahaan')
                ->className('dt-left'),
            Column::make('unit_dtl')
                ->title('Unit Detail')
                ->className('dt-left'),
            Column::make('signature')
                ->title('Tanda Tangan')
                ->className('dt-center')
                ->width(120)
                ->orderable(false)
                ->searchable(false),
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(80)
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'PresenceDetails_' . date('YmdHis');
    }
}
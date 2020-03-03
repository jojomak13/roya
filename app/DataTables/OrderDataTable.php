<?php

namespace App\DataTables;

use App\Order;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'admin.orders.btn')
            ->rawcolumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // $orders = Order::selectRaw('orders.*, users.first_name, users.last_name')
        //     ->join('users', 'orders.user_id', 'users.id');

        $orders = Order::with('user');

        return DataTables::of($orders);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orderdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'lengthMenu' => [[10, 25, 50, 100, -1], [10, 5, 50, 'All Record']],
                        'buttons' => [
                            ['extend' => 'create', 'className' => 'btn btn-primary', 'text' => '<i class="fa fa-plus">'],
                            ['extend' => 'reload', 'text' => '<i class="fa fa-refresh">'],
                            ['extend' => 'print', 'text' => '<i class="fa fa-print">'],
                            ['extend' => 'csv', 'text' => '<i class="fa fa-file-excel-o">'],
                        ]
                    ])
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'status',
                'data' => 'status',
                'title' => __('dashboard.orders.status')
            ],
            [
                'name' => 'total_price',
                'data' => 'total_price',
                'title' => __('dashboard.orders.total_price')
            ],
            [
                'name' => 'user.first_name',
                'data' => 'user.first_name',
                'title' => __('dashboard.orders.first_name')
            ],
            [
                'name' => 'user.last_name',
                'data' => 'user.last_name',
                'title' => __('dashboard.orders.last_name')
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => __('dashboard.orders.created_at')
            ],
            [
                'name' => 'action',
                'data' => 'action',
                'title' => __('dashboard.control'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Order_' . date('YmdHis');
    }
}

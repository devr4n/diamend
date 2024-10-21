<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
        <div class="text-right">
            @if(Route::currentRouteName() !== 'products.index')
                <a class="btn btn-primary btn-list btn-sm" href="{{ route('products.index') }}">
                    {{ __('general.title.product_list') }}
                </a>
            @endif
            <a class="btn btn-primary btn-create btn-sm" href="{{ route('products.create') }}">
                {{ __('general.title.add_new_product') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-bordered dataTable table-striped table-hover text-center" id="products-table">
                    <thead class="bg-light">
                    <tr>
                        <th>{{__('products.customer_name')}}</th>
                        <th>{{__('products.operation_type')}}</th>
                        <th>{{__('products.product_type')}}</th>
                        <th>{{__('products.description')}}</th>
                        <th class="text-nowrap">{{__('products.receive_date')}}</th>
                        <th class="text-info text-nowrap">{{__('products.due_date')}}</th>
                        <th>{{__('products.form.action')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for DataTable -->
<style>
    .dataTables_wrapper {
        width: 100%;
    }
    #products-table {
        width: 100% !important;
    }

    @media (max-width: 430px) {
        #products-table th, #products-table td {
            padding: 0.25rem;
            font-size: 0.75rem;
        }
    }
</style>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#products-table').DataTable({
                paging: true,
                scrollCollapse: true,
                scrollX: 2000,
                autoWidth: true,
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: false,
                ajax: '{!! route('products.data') !!}',
                columns: [
                    {data: 'customer.name', name: 'customer.name', searchable: true, orderable: true},
                    {
                        data: 'operation_type.name',
                        name: 'operation_type.localized_name',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'product_type.name',
                        name: 'product_type.localized_name',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row) {
                            return data.length > 100 ? data.substr(0, 60) + '...' : data;
                        }
                    },
                    {data: 'receive_date', name: 'receive_date', searchable: false, orderable: false},
                    {data: 'due_date', name: 'due_date', orderable: true},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center text-nowrap'
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    paginate: {
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>'
                    }
                }
            });

            window.addEventListener('refreshTable', event => {
                table.draw(false)
            })

        });
    </script>
@endpush

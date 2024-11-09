<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.product_list') }}</h6>
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
                        <th class="text-center">{{__('products.customer_name')}}</th>
                        <th class="text-center">{{__('products.operation_type')}}</th>
                        <th class="text-center">{{__('products.product_type')}}</th>
                        <th class="text-center">{{__('products.description')}}</th>
                        <th class="text-nowrap text-center">{{__('products.receive_date')}}</th>
                        <th class="text-info text-nowrap text-center">{{__('products.due_date')}}</th>
                        <th class="text-center">{{__('products.form.action')}}</th>
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
                scrollX: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: false,
                ajax: '{!! route('products.data') !!}',
                columns: [
                    {data: 'customer.name', name: 'customer.name', searchable: true, orderable: true, width: '15%'},
                    {data: 'operation_type.name', name: 'operation_type.localized_name', searchable: false, orderable: true, width: '15%'},
                    {data: 'product_type.name', name: 'product_type.localized_name', searchable: false, orderable: false, width: '15%'},
                    {data: 'description', name: 'description', searchable: false, orderable: false, width: '30%', render: function (data, type, row) {
                            return data.length > 50 ? data.substr(0, 25) + '...' : data;
                        }},
                    {data: 'receive_date', name: 'receive_date', searchable: false, orderable: false, className: 'text-center', width: '10%'},
                    {data: 'due_date', name: 'due_date', orderable: true, className: 'text-center', width: '10%'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center text-nowrap', width: '5%'},
                ],
                language: {
                    lengthMenu: '{{ __('customer.datatable_length_menu') }}',
                    info: '{{ __('customer.datatable_info') }}',
                    search: '{{ __('customer.datatable_search') }}',
                }
            });

            window.addEventListener('refreshTable', event => {
                table.draw(false)
            });
        });
    </script>
@endpush

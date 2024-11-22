<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.product_list') }}</h6>
        <div>
            @if(Route::currentRouteName() !== 'products.index')
                <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}">
                    {{ __('general.title.product_list') }}
                </a>
            @endif
            <a class="btn btn-primary btn-sm" href="{{ route('products.create') }}">
                {{ __('general.title.add_new_product') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table " id="products-table">
            <thead class="thead-light text-nowrap">
            <tr>
                <th>{{__('products.customer_name')}}</th>
                <th>{{__('products.operation_type')}}</th>
                <th>{{__('products.product_type')}}</th>
                <th>{{__('products.image')}}</th>
                <th>{{__('products.description')}}</th>
                <th>{{__('products.receive_date')}}</th>
                <th>{{__('products.due_date')}}</th>
                <th>{{__('products.form.action')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

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
                    {
                        data: 'customer.name',
                        name: 'customer.name',
                        searchable: true,
                        orderable: true,
                        className: 'text-center text-nowrap'
                    },
                    {
                        data: 'operation_type.name',
                        name: 'operation_type.localized_name',
                        searchable: false,
                        orderable: true,
                        className: 'text-center text-nowrap'
                    },
                    {
                        data: 'product_type.name',
                        name: 'product_type.localized_name',
                        searchable: false,
                        orderable: false,
                        className: 'text-center text-nowrap'
                    },
                    {
                        data: 'image_url',
                        name: 'image',
                        searchable: false,
                        orderable: false,
                        className: 'text-center text-nowrap',
                        render: function (data, type, row) {
                            return '<img src="' + data + '" class="img-thumbnail" style="width: 50px; height: 50px;">';
                        }
                    },
                    {
                        data: 'description',
                        name: 'description',
                        searchable: false,
                        orderable: false,
                        className: 'text-center text-nowrap',
                        render: function (data, type, row) {
                            return data.length > 25 ? data.substr(0, 25) + '...' : data;
                        }
                    },
                    {
                        data: 'receive_date',
                        name: 'receive_date',
                        searchable: false,
                        orderable: false,
                        className: 'text-center',
                    },
                    {
                        data: 'due_date',
                        name: 'due_date',
                        orderable: true,
                        className: 'text-center',
                        width: '10%',
                        render: function (data, type, row) {
                            return '<span class="badge badge-warning text-dark">' + data + '</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center text-nowrap',
                    },
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

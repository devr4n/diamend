<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.customer_list') }}</h6>
        <div class="text-right">
            <a class="btn btn-primary btn-create btn-sm" href="{{ route('customers.create') }}">
                <i class="fa-solid fa-plus"></i>
                {{ __('general.title.add_new_customer') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="dataTables_wrapper dt-bootstrap4">
                <table class="table" id="customers-table">
                    <thead class="thead-light text-nowrap">
                    <tr>
                        <th class="text-center">{{__('customer.form.name')}}</th>
                        <th class="text-center">{{__('customer.form.surname')}}</th>
                        <th class="text-center">{{__('customer.form.phone')}}</th>
                        <th class="text-center">{{__('customer.form.address')}}</th>
                        <th class="text-center">{{__('customer.form.action')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#customers-table')) {
                $('#customers-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('customers.data') }}',
                    columns: [
                        {data: 'name', name: 'name', className: ' text-nowrap'},
                        {data: 'surname', name: 'surname', className: 'text-center text-nowrap'},
                        {
                            data: 'phone_1',
                            name: 'phone_1',
                            className: 'text-center text-nowrap',
                            orderable: false,
                            render: function (data, type, row) {
                                return '<a href="tel:' + data + '" class="font-weight-bold">' + data + '</a>';
                            }
                        },
                        {data: 'address', name: 'address', orderable: false, className: 'text-center text-nowrap',
                            render: function (data, type, row) {
                                return data.length > 20 ? data.substr(0, 20) + '...' : data;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            className: 'text-center text-nowrap'
                        },
                    ],
                    language: {
                        lengthMenu: '{{ __('products.datatable_length_menu') }}',
                        info: '{{ __('products.datatable_info') }}',
                        search: '{{ __('products.datatable_search') }}',
                    }
                });
            }
        });
    </script>
@endpush

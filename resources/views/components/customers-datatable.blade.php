<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
        <div class="text-right">
            @if(Route::currentRouteName() !== 'customers.index')
                <a class="btn btn-primary btn-list btn-sm" href="{{ route('customers.index') }}">
                    {{ __('general.title.product_list') }}
                </a>
            @endif
            <a class="btn btn-primary btn-create btn-sm" href="{{ route('customers.create') }}">
                {{ __('general.title.add_new_product') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="dataTables_wrapper dt-bootstrap4">
                <table class="table table-bordered table-striped table-hover text-center" id="customers-table">
                    <thead class="bg-light">
                    <tr>
                        <th>{{__('customer.form.name')}}</th>
                        <th>{{__('customer.form.surname')}}</th>
                        <th>{{__('customer.form.phone')}}</th>
                        <th>{{__('customer.form.address')}}</th>
                        <th>{{__('customer.form.action')}}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for DataTable -->
<style>
    @media (max-width: 430px) {
        #customers-table th, #customers-table td {
            padding: 0.25rem;
            font-size: 0.75rem;
        }
    }
</style>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('customers.data') }}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'surname', name: 'surname'},
                    {
                        data: 'phone_1',
                        name: 'phone_1',
                        render: function (data, type, row) {
                            return '<a href="tel:' + data + '">' + data + '</a>';
                        }
                    },
                    {data: 'address', name: 'address'},
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
        });
    </script>
@endpush

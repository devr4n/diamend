<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.expense_list') }}</h6>
        <div>
            @if(Route::currentRouteName() !== 'expenses.index')
                <a class="btn btn-primary btn-sm" href="{{ route('expenses.index') }}">
                    {{ __('general.title.expense_list') }}
                </a>
            @endif
            <a class="btn btn-primary btn-sm" href="{{ route('expenses.create') }}">
                {{ __('general.title.add_new_expense') }}
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table " id="expenses-table">
            <thead class="thead-light text-nowrap text-center">
            <tr>
                <th>{{__('expenses.expense_type')}}</th>
                <th>{{__('expenses.amount')}} <small class="text-secondary">(₺)</small> </th>
                <th>{{__('expenses.date')}}</th>
                <th>{{__('expenses.note')}}</th>
                <th>{{__('expenses.action')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#expenses-table')) {
                $('#expenses-table').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    ajax: '{{ route('expenses.data') }}',
                    columns: [
                        {
                            data: 'expense_type.name',
                            name: 'expense_type.localized_name',
                            orderaable: true,
                            searchable: true,
                            className: 'text-center text-nowrap'
                        },
                        {data: 'amount', name: 'amount', className: 'text-center text-nowrap'},
                        {data: 'date', name: 'date', orderaable: true, searchable: true, className: 'text-center text-nowrap'},
                        {
                            data: 'note', name: 'note', orderable: false, className: 'text-center text-nowrap',
                            render: function (data, type, row) {
                                return data.length > 20 ? data.substr(0, 20) + '...' : data;
                            }
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center text-nowrap'},
                    ],
                    order: [[3, 'desc']],
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

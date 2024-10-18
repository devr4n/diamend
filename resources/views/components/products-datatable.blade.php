<div class="container-fluid">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center" id="products-table">
                    <thead class="bg-light">
                    <tr>
                        <th>{{__('product.customer_name')}}</th>
                        <th>{{__('product.operation_type')}}</th>
                        <th>{{__('product.product_type')}}</th>
                        <th>{{__('product.description')}}</th>
                        <th>{{__('product.delivery_date')}}</th>
                        <th>{{__('product.form.action')}}</th>
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
                // responsive: true,
                processing: true,
                serverSide: true,
                stateSave: false,
                ajax: '{!! route('products.data') !!}',
                columns: [
                    {data: 'customer.name', name: 'customer.name', searchable: true, orderable: true },
                    {data: 'operation_type.name', name: 'operation_type.localized_name', searchable: false, orderable: true },
                    {data: 'product_type.name', name: 'product_type.localized_name', searchable: false, orderable: false },
                    {data: 'description', name: 'description', searchable: false, orderable: false },
                    {data: 'delivery_date', name: 'delivery_date', orderable: true},
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

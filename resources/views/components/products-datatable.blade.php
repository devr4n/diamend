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

{{--Product Modal--}}
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{ __('Product Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>{{ __('Customer Name') }}:</strong> <span id="customer-name"></span></p>
                <p><strong>{{ __('Operation Type') }}:</strong> <span id="operation-type"></span></p>
                <p><strong>{{ __('Product Type') }}:</strong> <span id="product-type"></span></p>
                <p><strong>{{ __('Receive Date') }}:</strong> <span id="receive-date"></span></p>
                <p><strong>{{ __('Due Date') }}:</strong> <span id="due-date"></span></p>
                <p><strong>{{ __('Description') }}:</strong> <span id="description"></span></p>
                <p><strong>{{ __('Weight') }}:</strong> <span id="weight"></span></p>
                <p><strong>{{ __('Price') }}:</strong> <span id="price"></span></p>
                <p><strong>{{ __('Note') }}:</strong> <span id="note"></span></p>
                <p><strong>{{ __('Image') }}:</strong> <img id="image" class="img-thumbnail" style="width: 100px; height: 100px;" src=""></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
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
                stateSave: true,
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

        // Show product details modal
        function showModal(productId) {
            var productURL = '{{ route('products.show', ':id') }}';
            productURL = productURL.replace(':id', productId);

            $.get(productURL, function (data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                $('#customer-name').text(data.customer.name);
                $('#operation-type').text(data.operation_type.localized_name);
                $('#product-type').text(data.product_type.localized_name);
                $('#receive-date').text(data.receive_date);
                $('#due-date').text(data.due_date);
                $('#description').text(data.description);
                $('#weight').text(data.weight);
                $('#price').text(data.price);
                $('#note').text(data.note);
                $('#image').attr('src', data.image_url);
                $('#productModal').modal('show');
            });
        }
    </script>
@endpush

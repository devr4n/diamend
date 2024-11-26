{{--Product Modal--}}
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"
                    id="productModalLabel">{{ __('products.product_details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark fa-lg" title="Close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>{{ __('products.customer_name') }}:</strong> <span id="customer-name"></span>
                                </p>
                                <p><strong>{{ __('products.operation_type') }}:</strong> <span
                                        id="operation-type"></span></p>
                                <p><strong>{{ __('products.product_type') }}:</strong> <span id="product-type"></span>
                                </p>
                                <p><strong>{{ __('products.receive_date') }}:</strong> <span
                                        class="badge badge-info text-dark" id="receive-date"></span></p>
                                <p><strong>{{ __('products.due_date') }}:</strong> <span
                                        class="badge badge-warning text-dark" id="due-date"></span></p>
                            </div>
                            <div class="col-6">
                                <p><strong>{{ __('products.description') }}:</strong> <span id="description"></span></p>
                                <p><strong>{{ __('products.weight') }}:</strong> <span id="weight"></span> gr </p>
                                <p><strong>{{ __('products.price') }}:</strong> <span id="price"></span> ₺</p>
                            </div>
                        </div>
                        <p><strong>{{ __('products.note') }}:</strong> <span id="note"></span></p>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-4 text-center">
                        <p><strong>{{ __('products.image') }}</strong></p>
                        <img id="image" class="img-thumbnail rounded mb-3" style="width: 150px; height: 150px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('products.close') }}</button>
            </div>
        </div>
    </div>
</div>
{{--End of Product Modal--}}

<script>
    // Show product details modal
    function showModal(productId) {
        var productURL = '{{ route('products.show', ':id') }}';
        productURL = productURL.replace(':id', productId);

        $.get(productURL, function (data) {
            if (data.error) {
                alert(data.error);
                return;
            }

            $('#customer-name').text(data.customer.name || '-');
            $('#operation-type').text(data.operation_type.localized_name || '-');
            $('#product-type').text(data.product_type.localized_name || '-');
            $('#receive-date').text(data.receive_date || '-');
            $('#due-date').text(data.due_date || '-');
            $('#description').text(data.description || '-');
            $('#weight').text(data.weight || '-');
            $('#price').text(data.price || '-');
            $('#note').text(data.note || '-');
            $('#image').attr('src', data.image_url);
            $('#productModal').modal('show');
        });
    }
</script>

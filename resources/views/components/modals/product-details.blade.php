{{--Product Modal--}}
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="productModalLabel">{{ __('products.product_details') }}</h5>
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
                                <p><strong>{{ __('Customer Name') }}:</strong> <span id="customer-name"></span></p>
                                <p><strong>{{ __('Operation Type') }}:</strong> <span id="operation-type"></span></p>
                                <p><strong>{{ __('Product Type') }}:</strong> <span id="product-type"></span></p>
                                <p><strong>{{ __('Receive Date') }}:</strong> <span id="receive-date"></span></p>
                            </div>
                            <div class="col-6">
                                <p><strong>{{ __('Due Date') }}:</strong> <span id="due-date"></span></p>
                                <p><strong>{{ __('Description') }}:</strong> <span id="description"></span></p>
                                <p><strong>{{ __('Weight') }}:</strong> <span id="weight"></span></p>
                                <p><strong>{{ __('Price') }}:</strong> <span id="price"></span></p>
                            </div>
                        </div>
                        <p><strong>{{ __('Note') }}:</strong> <span id="note"></span></p>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-4 text-center">
                        <p><strong>{{ __('Image') }}:</strong></p>
                        <img id="image" class="img-thumbnail rounded mb-3" style="width: 150px; height: 150px;" src="" alt="Product Image">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
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

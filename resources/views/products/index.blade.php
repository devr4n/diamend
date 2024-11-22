@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.products') }}</h1>

    <div class="row1 mx-11 my-2 d-flex1">
        <div id="left-table" class="px-4" style="width: 100%">
            @if(Route::currentRouteName() === 'products.index')
                @include('components.products-datatable')
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
                                <!-- Product details will be loaded here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('click', '.view-product', function () {
            var productId = $(this).data('id');
            $.ajax({
                url: `/products/${productId}`,
                method: 'GET',
                success: function (response) {
                    $('#productModal .modal-body').html(response);
                    $('#productModal').modal('show');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush

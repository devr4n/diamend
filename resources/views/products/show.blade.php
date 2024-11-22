<div>
    <h5>{{ $product->description }}</h5>
    <p>{{ __('Customer') }}: {{ $product->customer->name }}</p>
    <p>{{ __('Operation Type') }}: {{ $product->operationType->localized_name }}</p>
    <p>{{ __('Product Type') }}: {{ $product->productType->localized_name }}</p>
    <p>{{ __('Receive Date') }}: {{ $product->receive_date }}</p>
    <p>{{ __('Due Date') }}: {{ $product->due_date }}</p>
    <!-- Add more fields as needed -->
</div>

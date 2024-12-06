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
        <table class="table " id="products-table">
            <thead class="thead-light text-nowrap">
            <tr>
                <th>{{__('products.id')}}</th>
                <th>{{__('products.customer_name')}}</th>
                <th>{{__('products.operation_type')}}</th>
                <th>{{__('products.product_type')}}</th>
                <th>{{__('products.image')}}</th>
                <th>{{__('products.status')}}</th>
                <th>{{__('products.receive_date')}}</th>
                <th>{{__('products.due_date')}}</th>
                <th>{{__('products.form.action')}}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@push('scripts')

@endpush

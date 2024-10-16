<div>
    <div class="text-right mb-3">
        @if($mode !== 'list')
            <input type="button"
                   class="btn btn-primary btn-list btn-sm" value="{{ __('general.title.product_list') }}"
                   wire:click="setMode('list')"/>
        @endif
        @if($mode !== 'create')
            <input type="button"
                   class="btn btn-primary btn-create btn-sm" value="{{ __('general.title.add_new_product') }}"
                   wire:click="setMode('create')"/>
        @endif
    </div>

    <div class="view-mode view-mode--{{ $mode }}">
        @if($mode === 'list')
            <x-products-datatable/>
        @elseif($mode === 'create' || $mode === 'edit')
            <livewire:product-crud :mode="$mode" :id="$productId"/>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('reloadDataTable', function () {
                $('#products-table').DataTable().ajax.reload();
            });
        });
    </script>
@endpush

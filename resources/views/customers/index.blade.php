@extends('layouts.app')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <div class="text-right">
                @if($mode !== 'list')
                    <input type="button"
                           class="btn btn-primary btn-list btn-sm" value="{{ __('general.title.customer_list') }}"
                           onclick="Livewire.emit('AddEditCustomer', 'list')"/>
                @endif
                @if($mode !== 'create')
                    <input type="button"
                           class="btn btn-primary btn-create btn-sm" value="{{ __('general.title.add_new_customer') }}"
                           onclick="Livewire.emit('AddEditCustomer', 'create')"/>
                @endif
            </div>
        </div>

        <div class="card-body view-mode view-mode--{{ $mode }}">
            @if($mode === 'list')
                <x-customers-datatable/>
            @elseif($mode === 'create' || $mode === 'edit')
                <livewire:customer-crud mode="{{ $mode }}" :id="$id ?? null"/>
            @endif
        </div>
    </div>
@endsection

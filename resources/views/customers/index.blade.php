@extends('layouts.app')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <div class="text-right">
                <input type="button"
                       class="btn btn-primary btn-list" value="{{ __('general.title.customer_list') }}"
                       onclick="Livewire.dispatch('changeViewMode', 'list')"/>
                <input type="button"
                       class="btn btn-primary btn-create" value="{{ __('general.title.add_new_customer') }}"
                       onclick="Livewire.dispatch('changeViewMode', 'create')"/>
            </div>
        </div>

        <div class="card-body view-mode view-mode--{{ $mode }}">
            @if($mode === 'list')
                <x-customers-datatable/>
            @elseif($mode === 'create' || $mode === 'edit')
                <livewire:customer-crud :mode="$mode" :id="$entryId"/>
            @endif
        </div>
    </div>
@endsection

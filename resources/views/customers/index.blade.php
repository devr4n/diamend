@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>

    <div class="row1 mx-11 my-2 d-flex1">
        <div id="left-table" class="px-4" style="width: 100%">
            @if(Route::currentRouteName() === 'customers.index')
                @include('components.customers-datatable')
            @endif
        </div>
    </div>

@endsection

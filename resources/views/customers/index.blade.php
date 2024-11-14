@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>

    <div class="">
        @if(Route::currentRouteName() === 'customers.index')
            @include('components.customers-datatable')
        @endif
    </div>

@endsection

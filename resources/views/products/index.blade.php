@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.products') }}</h1>

    <div class="">
        @if(Route::currentRouteName() === 'products.index')
            @include('components.products-datatable')
        @endif
    </div>

@endsection

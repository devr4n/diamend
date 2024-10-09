@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.products') }}</h1>

    <div class="row">

        @include('livewire.product-crud')

    </div>

@endsection

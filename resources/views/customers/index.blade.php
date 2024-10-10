@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>

    <div class="row">

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Customers Datatable</h6>
            </div>

            <livewire:customer-crud mode="{{$mode}}" :id="$id??null"/>


            <x-customers-datatable/>

        </div>
    </div>

@endsection

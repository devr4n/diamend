@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.customers') }}</h1>
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{__('general.title.customer_list')}}</h6>
            <div class="text-right">
                @if(Route::currentRouteName() !== 'customers.index')
                    <a class="btn btn-primary btn-list btn-sm" href="{{ route('customers.index') }}">
                        {{ __('general.title.product_list') }}
                    </a>
                @endif
                @if(Route::currentRouteName() !== 'customers.create')
                    <a class="btn btn-primary btn-create btn-sm" href="{{ route('customer.create') }}">
                        {{ __('general.title.add_new_customer') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf

                <h6 class="heading-small text-muted mb-4">{{ __('general.title.customer_information') }}</h6>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="name">
                                    {{ __('general.input.name') }} <span class="small text-danger">*</span>
                                </label>
                                <input type="text" id="name" class="form-control" name="name"
                                       placeholder="{{ __('general.input.name') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="surname">
                                    {{ __('general.input.surname') }} <span class="small text-danger">*</span>
                                </label>
                                <input type="text" id="surname" class="form-control" name="surname"
                                       placeholder="{{ __('general.input.surname') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="phone_1">
                                    {{ __('general.input.phone') }} | 1 <span class="small text-danger">*</span>
                                </label>
                                <input type="tel" id="phone_1" class="form-control" name="phone_1"
                                       placeholder="{{ __('general.input.phone') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="phone_2">
                                    {{ __('general.input.phone') }} | 2
                                </label>
                                <input type="tel" id="phone_2" class="form-control" name="phone_2"
                                       placeholder="{{ __('general.input.phone') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="email">
                                    {{ __('general.input.address') }} <span class="small text-danger">*</span>
                                </label>
                                <textarea id="address" class="form-control" name="address" maxlength="100"
                                          placeholder="Lefkoşa" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">{{ __('general.form.save') }}</span>
                            </button>
                            <button type="submit" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">{{ __('general.form.delete') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

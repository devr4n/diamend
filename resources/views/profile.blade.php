@extends('layouts.app')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.profile') }}</h1>

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

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold"
                            style="font-size: 60px; height: 180px; width: 180px;"
                            data-initial="{{ Auth::user()->name[0] }}"></figure>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->fullName }}</h5>
                                <p>Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('general.profile_details') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <ul class="text-muted">
                            <li>{{ __('general.title.user_information') }}</li>
                            <li><span class="text-danger">*</span> {{ __('general.title.required_fields') }}</li>
                        </ul>
                        <hr>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="name">
                                            {{ __('general.input.name') }} <span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name"
                                               placeholder="{{ __('general.input.name') }}"
                                               value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="last_name">{{ __('general.input.surname') }}</label>
                                        <input type="text" id="last_name" class="form-control" name="last_name"
                                               placeholder="{{ __('general.input.name') }}"
                                               value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">{{ __('general.input.email') }}
                                            <span
                                                class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email"
                                               placeholder="ornek@ornek.com"
                                               value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">
                                            {{ __('general.input.current_password') }}
                                        </label>
                                        <input type="password" id="current_password" class="form-control"
                                               name="current_password"
                                               placeholder="{{ __('general.input.current_password') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">
                                            {{ __('general.input.new_password') }}
                                        </label>
                                        <input type="password" id="new_password" class="form-control"
                                               name="new_password" placeholder="{{ __('general.input.new_password') }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">
                                            {{ __('general.input.confirm_password') }}
                                        </label>
                                        <input type="password" id="confirm_password" class="form-control"
                                               name="password_confirmation" placeholder="{{ __('general.input.confirm_password') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('general.form.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

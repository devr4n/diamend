@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.expenses') }}</h1>

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
            <h6 class="m-0 font-weight-bold text-primary">{{__('general.title.add_new_expense')}}</h6>
            <div class="text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('expenses.index') }}">
                    <i class="fa-solid fa-list"></i>
                    {{ __('general.title.expense_list') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('expenses.store') }}">
                @csrf

                <ul class="text-muted">
                    <li>{{ __('general.title.expense_information_1') }}</li>
                    <li><span class="text-danger">*</span> {{ __('general.title.required_fields') }}</li>
                </ul>
                <hr>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="expense_type_id">
                                    {{ __('expenses.expense_type') }} <span class="small text-danger">*</span>
                                </label>
                                <select class="form-control select2" id="expense_type_id" name="expense_type_id"
                                        required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($expenseTypes as $expenseType)
                                        <option
                                            value="{{ $expenseType->id }}">{{ $expenseType->localized_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="amount">
                                    {{ __('expenses.amount') }} <small class="text-secondary">(₺)</small>
                                    <span class="small text-danger">*</span>
                                </label>
                                <input type="number" id="amount" class="form-control" name="amount" min="0"
                                       placeholder="{{ __('expenses.amount') }} (₺)" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="date">
                                    {{ __('expenses.date') }} <span class="small text-danger">*</span>
                                </label>
                                <input type="date" id="date" class="form-control" name="date"
                                       placeholder="{{ __('expenses.date') }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="note">
                                    {{ __('expenses.note') }}
                                </label>
                                <textarea id="note" class="form-control" name="note" maxlength="100"
                                          placeholder="{{ __('expenses.note') }}"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                </div>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-check"></i></span>
                                <span class="text">{{ __('general.form.save') }}</span>
                            </button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

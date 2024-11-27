@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.products') }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.add_new_product') }}</h6>
            <div class="text-right">
                <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}">
                    {{ __('general.title.product_list') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <ul class="text-muted">
                    <li>{{ __('general.title.product_information_1') }}</li>
                    <li><span class="text-danger">*</span> {{ __('general.title.required_fields') }}</li>
                </ul>
                <hr>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="customer">
                                    {{ __('customer.customer') }} <span class="text-danger">*</span>
                                </label>
                                <select id="customer_id" class="form-control select2" name="customer_id" required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($customers as $customer)
                                        <option
                                            value="{{ $customer->id }}">{{ $customer->name }} {{ $customer->surname }}</option>
                                    @endforeach
                                </select>
                                <a href="{{ route('customers.create') }}" class="text-decoration-none">
                                    <small class="text-primary">{{__('products.click_to_create')}}</small>
                                </a>
                                @error('customer_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="operation_type">
                                    {{ __('products.operation_type') }} <span class="text-danger">*</span>
                                </label>
                                <select id="operation_type_id" class="form-control select2" name="operation_type_id"
                                        required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($operationTypes as $operationType)
                                        <option
                                            value="{{ $operationType->id }}">{{ $operationType->localized_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="product_type">
                                    {{ __('products.product_type') }} <span class="text-danger">*</span>
                                </label>
                                <select id="product_type_id" class="form-control select2" name="product_type_id"
                                        required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($productTypes as $productType)
                                        <option
                                            value="{{ $productType->id }}">{{ $productType->localized_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description">
                                    {{ __('products.description') }} <span class="text-danger">*</span>
                                </label>
                                <textarea id="description" class="form-control textAreaMultiline" name="description"
                                          maxlength="100"
                                          placeholder="4 Gümüş Kolye Sipariş \n3 Altin Bileklik Tamir"
                                          required></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Dates --}}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="receive_date">
                                    {{ __('products.receive_date') }} <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="receive_date" class="form-control" name="receive_date"
                                       placeholder="{{ __('products.receive_date') }}">
                                @error('receive_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label text-danger" for="due_date">
                                    {{ __('products.due_date') }} <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="due_date" class="form-control" name="due_date"
                                       placeholder="{{ __('products.due_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="delivery_date">
                                    {{ __('products.delivery_date') }}
                                </label>
                                <input type="date" id="delivery_date" class="form-control" name="delivery_date"
                                       placeholder="{{ __('products.delivery_date') }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Product Details --}}

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="weight">
                                    {{ __('products.weight') }} <span class="text-secondary">(gr)</span>
                                </label>
                                <input type="number" id="weight" class="form-control" name="weight" min="0" value="0"
                                       step="0.01"
                                       placeholder="{{ __('products.weight') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="price">
                                    {{ __('products.price') }} <span class="text-secondary">(₺)</span>
                                </label>
                                <input type="number" id="price" class="form-control" name="price" min="0" value="0"
                                       placeholder="{{ __('products.price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="material_type">
                                    {{ __('products.material_type') }}
                                </label>
                                <select id="material_type_id" class="form-control select2" name="material_type_id">
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($materialTypes as $materialType)
                                        <option
                                            value="{{ $materialType->id }}">{{ $materialType->localized_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="material_weight">
                                    {{ __('products.material_weight') }} <span class="text-secondary">(gr)</span>
                                </label>
                                <input type="number" id="material_weight" class="form-control" name="material_weight"
                                       min="0" value="0" step="0.01"
                                       placeholder="{{ __('products.material_weight') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="note">
                                    {{ __('products.note') }}
                                </label>
                                <textarea id="note" class="form-control" name="note" maxlength="100"
                                          placeholder="100TL Kapora Alındı"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="form-control-label">{{ __('products.image') }}</label>
                                <input class="form-control" id="image" type="file" name="image">
                            </div>
                        </div>
                    </div>

                    <hr>


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
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let textAreas = document.getElementsByTagName('textarea');

            Array.prototype.forEach.call(textAreas, function (elem) {
                elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
            });
        });


        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

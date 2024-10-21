@extends('layouts.app')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('general.products') }}</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            <div class="text-right">
                @if(Route::currentRouteName() !== 'products.index')
                    <a class="btn btn-primary btn-list btn-sm" href="{{ route('products.index') }}">
                        {{ __('general.title.product_list') }}
                    </a>
                @endif
                @if(Route::currentRouteName() !== 'products.create')
                    <a class="btn btn-primary btn-create btn-sm" href="{{ route('products.create') }}">
                        {{ __('general.title.add_new_product') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <h6 class="heading-small text-muted mb-4">{{ __('general.title.product_information') }}</h6>

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="customer">
                                    {{ __('customer.customer') }} <span class="small text-danger">*</span>
                                </label>
                                <select id="customer_id" class="form-control select2" name="customer_id" required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="operation_type">
                                    {{ __('products.operation_type') }} <span class="small text-danger">*</span>
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
                            <div class="form-group focused">
                                <label class="form-control-label" for="product_type">
                                    {{ __('products.product_type') }} <span class="small text-danger">*</span>
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
                                    {{ __('products.description') }} <span class="small text-danger">*</span>
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
                                    {{ __('products.receive_date') }}
                                </label>
                                <input type="date" id="receive_date" class="form-control" name="receive_date"
                                       placeholder="{{ __('products.receive_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label text-danger" for="due_date">
                                    {{ __('products.due_date') }}
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

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="weight">
                                    {{ __('products.weight') }} <span class="small text-secondary">(gr)</span>
                                </label>
                                <input type="number" id="weight" class="form-control" name="weight"
                                       placeholder="{{ __('products.weight') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="price">
                                    {{ __('products.price') }}
                                </label>
                                <input type="number" id="price" class="form-control" name="price"
                                       placeholder="{{ __('products.price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="material_type">
                                    {{ __('products.material_type') }}
                                </label>
                                <select id="material_type_id" class="form-control select2" name="material_type_id"
                                        required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    @foreach($materialTypes as $materialType)
                                        <option
                                            value="{{ $materialType->id }}">{{ $materialType->localized_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="material_weight">
                                    {{ __('products.material_weight') }} <span class="small text-secondary">(gr)</span>
                                </label>
                                <input type="number" id="material_weight" class="form-control" name="material_weight"
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
                                          placeholder="100TL Kapora Alındı" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="image">
                                    {{ __('products.image') }}
                                </label>
                                <input type="file" id="image" name="image" class="form-control-file">
                            </div>
                        </div>
                    </div>

                    <hr>


                </div>

                <!-- Button -->
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
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
    </script>
@endpush

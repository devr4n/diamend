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

<div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" name="_method" value="PUT">

    <h6 class="heading-small text-muted mb-4">{{ __('general.title.product_information') }}</h6>

    <div class="pl-lg-4">

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group focused">
                    <label class="form-control-label" for="customer">
                        {{ __('customer.customer') }} <span class="small text-danger">*</span>
                    </label>
                    <select wire:model="product.customer_id" id="customer_id" class="form-control select2"
                            onchange="@this.set('product.customer_id', $(this).val())"
                            name="customer" required>
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
                    <select wire:model="product.operation_type_id" id="operation_type_id" class="form-control select2"
                            name="operation_type" required>
                        <option value="">{{ __('general.form.select') }}</option>
                        @foreach($operationTypes as $operationType)
                            <option value="{{ $operationType->id }}">{{ $operationType->localized_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group focused">
                    <label class="form-control-label" for="product_type">
                        {{ __('products.product_type') }} <span class="small text-danger">*</span>
                    </label>
                    <select wire:model="product.product_type_id" id="product_type_id" class="form-control select2"
                            name="product_type" required>
                        <option value="">{{ __('general.form.select') }}</option>
                        @foreach($productTypes as $productType)
                            <option value="{{ $productType->id }}">{{ $productType->localized_name }}</option>
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
                    <textarea id="address" class="form-control textAreaMultiline" name="description" maxlength="100"
                              placeholder="4 Gümüş Kolye Sipariş \n3 Altin Bileklik Tamir" required></textarea>
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
                    <input wire:model="product.receive_date"
                           type="date" id="receive_date" class="form-control" name="receive_date"
                           placeholder="{{ __('products.receive_date') }}">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label text-danger" for="due_date">
                        {{ __('products.due_date') }}
                    </label>
                    <input wire:model="product.due_date"
                        type="date" id="due_date" class="form-control" name="due_date"
                           placeholder="{{ __('products.due_date') }}">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label" for="delivery_date">
                        {{ __('products.delivery_date') }}
                    </label>
                    <input wire:model="product.delivery_date"
                        type="date" id="delivery_date" class="form-control" name="delivery_date"
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
                    <input wire:model="product.weight"
                        type="number" id="weight" class="form-control" name="weight"
                           placeholder="{{ __('products.weight') }}" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label" for="price">
                        {{ __('products.price') }}
                    </label>
                    <input wire:model="product.price"
                        type="number" id="price" class="form-control" name="price"
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
                    <input wire:model="product.material_type"
                        type="number" id="material_type" class="form-control" name="material_type"
                           placeholder="{{ __('products.material_type') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label" for="material_weight">
                        {{ __('products.material_weight') }} <span class="small text-secondary">(gr)</span>
                    </label>
                    <input wire:model="product.material_weight"
                        type="number" id="material_weight" class="form-control" name="material_weight"
                           placeholder="{{ __('products.material_weight') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label" for="note">
                        {{ __('products.note') }}
                    </label>
                    <textarea wire:model="product.note"
                        id="note" class="form-control" name="note" maxlength="100"
                              placeholder="100TL Kapora Alındı" required></textarea>
                </div>
            </div>
        </div>

    </div>

    <!-- Button -->
    <div class="pl-lg-4">
        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary btn-icon-split btn-sm"
                        wire:ignore id="submitBtn" wire:click="save()">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">{{__($mode == 'create' ? 'general.form.save' : 'general.form.update')}}</span>
                </button>
                <button type="submit" class="btn btn-danger btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">{{ __('general.form.delete') }}</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let textAreas = document.getElementsByTagName('textarea');

            Array.prototype.forEach.call(textAreas, function (elem) {
                elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
            });
        });
    </script>
@endpush

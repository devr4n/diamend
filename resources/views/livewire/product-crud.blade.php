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


<div class="col-lg-12 order-lg-1">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('general.title.add_new_product') }}
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
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
                                <select id="customer" class="form-control select2" name="customer" required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    {{--                                    @foreach($customers as $customer)--}}
                                    {{--                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="operation_type">
                                    {{ __('customer.operation') }} <span class="small text-danger">*</span>
                                </label>
                                <select id="customer" class="form-control select2" name="operation_type" required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    {{--                                    @foreach($customers as $customer)--}}
                                    {{--                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group focused">
                                <label class="form-control-label" for="product_type">
                                    {{ __('customer.product_type') }} <span class="small text-danger">*</span>
                                </label>
                                <select id="customer" class="form-control select2" name="product_type" required>
                                    <option value="">{{ __('general.form.select') }}</option>
                                    {{--                                    @foreach($customers as $customer)--}}
                                    {{--                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>--}}
                                    {{--                                    @endforeach--}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description">
                                    {{ __('customer.description') }} <span class="small text-danger">*</span>
                                </label>
                                <textarea id="address" class="form-control textAreaMultiline" name="description" maxlength="100"
                                          placeholder="4 Gümüş Kolye Sipariş \n3 Altin Bileklik Tamir" required></textarea>
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

</div>

<script>
    var textAreas = document.getElementsByTagName('textarea');

    Array.prototype.forEach.call(textAreas, function(elem) {
        elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
    });
</script>

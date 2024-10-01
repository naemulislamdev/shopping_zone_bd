@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product Add'))

@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('admin.dashboard') }}">{{ \App\CPU\translate('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('admin.product.list', 'in_house') }}">{{ \App\CPU\translate('Product') }}</a>
                </li>
                <li class="breadcrumb-item">{{ \App\CPU\translate('Add') }} {{ \App\CPU\translate('New') }} </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{ route('admin.product.store') }}" method="POST"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                    enctype="multipart/form-data" id="product_form">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @php($language = \App\Model\BusinessSetting::where('type', 'pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])
                            <ul class="nav nav-tabs mb-4">
                                @foreach (json_decode($language) as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link {{ $lang == $default_lang ? 'active' : '' }}"
                                            href="#"
                                            id="{{ $lang }}-link">{{ \App\CPU\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            @foreach (json_decode($language) as $lang)
                                <div class="{{ $lang != $default_lang ? 'd-none' : '' }} lang_form"
                                    id="{{ $lang }}-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="{{ $lang }}_name">{{ \App\CPU\translate('name') }}
                                            ({{ strtoupper($lang) }}) <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" {{ $lang == $default_lang ? 'required' : '' }} name="name[]"
                                            id="{{ $lang }}_name" class="form-control" placeholder="New Product">
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    <div class="form-group pt-4">
                                        <label class="input-label"
                                            for="{{ $lang }}_description">{{ \App\CPU\translate('description') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <textarea name="description[]" class="editor" id="summernote" cols="30" rows="60">{{ old('details') }}</textarea>
                                    </div>
                                    <div class="form-group pt-4">
                                        <label class="input-label"
                                            for="{{ $lang }}_description">{{ \App\CPU\translate(' short description') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <textarea name="short_description[]" class="editor" id="summernote1" cols="30" rows="30">{{ old('short_description') }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{ \App\CPU\translate('General Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Category') }} <span class="text-danger">*</span></label>
                                        <select class="js-example-basic-multiple form-control" name="category_id"
                                            onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-category-select','select')"
                                            required>
                                            <option value="{{ old('category_id') }}" selected disabled>---Select---
                                            </option>
                                            @foreach ($cat as $c)
                                                <option value="{{ $c['id'] }}"
                                                    {{ old('name') == $c['id'] ? 'selected' : '' }}>
                                                    {{ $c['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Sub Category') }}</label>
                                        <select class="js-example-basic-multiple form-control" name="sub_category_id"
                                            id="sub-category-select"
                                            onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-sub-category-select','select')">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Sub Sub Category') }}</label>
                                        <select class="js-example-basic-multiple form-control" name="sub_sub_category_id"
                                            id="sub-sub-category-select">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ \App\CPU\translate('product_code_sku') }}
                                                <span class="text-danger">*</span>
                                                <a class="style-one-pro" style="cursor: pointer;"
                                                    onclick="document.getElementById('generate_number').value = getRndInteger()">{{ \App\CPU\translate('generate') }}
                                                    {{ \App\CPU\translate('code') }}</a></label>
                                            <input type="text" minlength="6" id="generate_number" name="code"
                                                class="form-control" value="{{ old('code') }}"
                                                placeholder="{{ \App\CPU\translate('code') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Brand') }} <span class="text-danger">*</span></label> <a href="{{route('admin.brand.add-new')}}" target="_blank">add new</a>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="brand_id" required>
                                            <option value="{{ null }}" selected disabled>
                                                ---{{ \App\CPU\translate('Select') }}---</option>
                                            @foreach ($br as $b)
                                                <option value="{{ $b['id'] }}">{{ $b['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Unit') }} <span class="text-danger">*</span></label>
                                        <select class="js-example-basic-multiple form-control" name="unit">
                                            @foreach (\App\CPU\Helpers::units() as $x)
                                                <option value="{{ $x }}" {{ old('unit') == $x ? 'selected' : '' }}>
                                                    {{ $x }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{ \App\CPU\translate('Variations') }}</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="colors">
                                            {{ \App\CPU\translate('Colors') }} :
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" class="status" value="{{ old('colors_active') }}"
                                                name="colors_active">
                                            <span class="slider round"></span>
                                        </label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="colors[]" multiple="multiple" id="colors-selector" disabled>
                                            @foreach (\App\Model\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                <option value="{{ $color->code }}">
                                                    {{ $color['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="attributes" style="padding-bottom: 3px">
                                            {{ \App\CPU\translate('Attributes') }} :
                                        </label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="choice_attributes[]" id="choice_attributes" multiple="multiple">
                                            @foreach (\App\Model\Attribute::orderBy('name', 'asc')->get() as $key => $a)
                                                <option value="{{ $a['id'] }}">
                                                    {{ $a['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="customer_choice_options" id="customer_choice_options"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{ \App\CPU\translate('Product price & stock') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">{{ \App\CPU\translate('Unit price') }}</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" min="0" step="0.01"
                                            placeholder="{{ \App\CPU\translate('Unit price') }}" name="unit_price"
                                            value="{{ old('unit_price') }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">{{ \App\CPU\translate('Purchase price') }}</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" min="0" step="0.01"
                                            placeholder="{{ \App\CPU\translate('Purchase price') }}"
                                            value="{{ old('purchase_price') }}" name="purchase_price"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-4">
                                        <label class="control-label">{{ \App\CPU\translate('Tax') }} <span class="text-danger">*</span></label>
                                        <label class="badge badge-info">{{ \App\CPU\translate('Percent') }} ( % )</label>
                                        <input type="number" min="0" value="0" step="0.01"
                                            placeholder="{{ \App\CPU\translate('Tax') }}" name="tax"
                                            value="{{ old('tax') }}" class="form-control">
                                        <input name="tax_type" value="percent" style="display: none">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="control-label">{{ \App\CPU\translate('Discount') }}</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" min="0" value="{{ old('discount') }}"
                                            step="0.01" placeholder="{{ \App\CPU\translate('Discount') }}"
                                            name="discount" class="form-control" required value="0">
                                    </div>
                                    <div class="col-md-4" style="padding-top: 30px;">
                                        <select style="width: 100%"
                                            class="js-example-basic-multiple js-states js-example-responsive demo-select2"
                                            name="discount_type">
                                            <option value="flat">{{ \App\CPU\translate('Flat') }}</option>
                                            <option value="percent">{{ \App\CPU\translate('Percent') }}</option>
                                        </select>
                                    </div>
                                    <div class="pt-4 col-12 sku_combination" id="sku_combination">

                                    </div>
                                    <div class="col-md-3" id="quantity">
                                        <label class="control-label">{{ \App\CPU\translate('total') }}
                                            {{ \App\CPU\translate('Quantity') }}</label>
                                            <span class="text-danger">*</span>
                                        <input type="number" min="0" value="0" step="1"
                                               placeholder="{{ \App\CPU\translate('Quantity') }}" name="current_stock"
                                               class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="minimum_order_qty">
                                        <label class="control-label">
                                            {{ \App\CPU\translate('minimum_order_quantity') }} <span class="text-danger">*</span></label>
                                        <input type="number" min="1" value="1" step="1"
                                            placeholder="{{ \App\CPU\translate('minimum_order_quantity') }}" name="minimum_order_qty"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="shipping_cost">
                                        <label class="control-label">{{ \App\CPU\translate('shipping_cost') }} </label>
                                        <input type="number" min="0" value="0" step="1"
                                            placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="shipping_cost"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="shipping_cost_multy">
                                        <div>
                                            <label
                                                class="control-label">{{ \App\CPU\translate('shipping_cost_multiply_with_quantity') }}
                                            </label>

                                        </div>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" name="multiplyQTY" id="">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                      <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>Product campaign Discount</h4>
                        </div>
                        <div class="card-body">
                            <div class="set-form">
                              <table id="myTable" class="table table-bordered">
                                <tr>
                                  <th>Start Day</th>
                                  <th>End Day</th>
                                  <th>Discount(%)</th>
                                  <th>Action</th>
                                </tr>
                                <tr>
                                  <td>
                                   <input type="date"
                                            placeholder="start day" name="start_day[]"
                                            value="" class="form-control" required>
                                  </td>
                                  <td>
                                    <input class="form-control" type="date" placeholder="end day" name="end_day[]" value="" required>
                                  </td>
                                  <td>
                                    <input type="number"
                                            placeholder="Discount" name="discountCam[]"
                                            value="" class="form-control" required>
                                  </td>
                                </tr>
                              </table>
                              <div class="set-form">
                                <input type="button" id="more_fields" onclick="add_fields();" value="Add More" class="btn btn-info" />
                              </div>
                        </div>
                    </div>
                    </div>

                    <div class="card mt-2 mb-2 rest-part">
                        <div class="card-header">
                            <h4>{{ \App\CPU\translate('seo_section') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="control-label">{{ \App\CPU\translate('Meta Title') }}</label>
                                    <input type="text" name="meta_title" placeholder="" class="form-control">
                                </div>

                                <div class="col-md-8 mb-4">
                                    <label class="control-label">{{ \App\CPU\translate('Meta Description') }}</label>
                                    <textarea rows="10" type="text" id="summernote2" name="meta_description" class="form-control"></textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label>{{ \App\CPU\translate('Meta Image') }}</label>
                                    </div>
                                    <div class="border border-dashed">
                                        <div class="row" id="meta_img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label class="control-label">{{ \App\CPU\translate('Youtube video link') }}</label>
                                    <small class="badge badge-soft-danger"> (
                                        {{ \App\CPU\translate('optional, please provide embed link not direct link') }}.
                                        )</small>
                                    <input type="text" name="video_link"
                                        placeholder="{{ \App\CPU\translate('EX') }} : https://www.youtube.com/embed/5R06LRdUCSE"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label
                                            class="control-label">{{ \App\CPU\translate('Video shopping') }}
                                        </label>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" class="status" value="{{ old('video_shopping') }}"
                                            name="video_shopping">
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ \App\CPU\translate('Upload product images') }}</label><small
                                            style="color: red">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</small>
                                    </div>
                                    <div class="p-2 border border-dashed" style="max-width:430px;">
                                        <div class="row" id="coba"></div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Size Chart</label><small
                                            style="color: red"> ( Optional )</small>
                                    </div>
                                    <div style="max-width:200px;">
                                        <div class="row" id="size_chart"></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">{{ \App\CPU\translate('Upload thumbnail') }}</label><small
                                            style="color: red">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</small>
                                    </div>
                                    <div style="max-width:200px;">
                                        <div class="row" id="thumbnail"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="button" onclick="check()"
                                    class="btn btn-primary float-right">{{ \App\CPU\translate('Submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 10,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#size_chart").spartanMultiImagePicker({
                fieldName: 'size_chart',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: '280px',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '90%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            // dir: "rtl",
            width: 'resolve'
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    console.log(data);

                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i +
                '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="{{ trans('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="{{ trans('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>'
                );

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }


        $('#colors-selector').on('change', function() {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function() {
            update_sku();
        });

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{ route('admin.product.sku-combination') }}',
                data: $('#product_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function() {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>

    <script>
        function check() {
            Swal.fire({
                title: '{{ \App\CPU\translate('Are you sure') }}?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {

                var formData = new FormData(document.getElementById('product_form'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{ route('admin.product.store') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        // return false;
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            toastr.success(
                            '{{ \App\CPU\translate('product added successfully') }}!', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('#product_form').submit();
                        }
                    }
                });
            })
        };
    </script>

    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{ $default_lang }}') {
                $(".rest-part").removeClass('d-none');
            } else {
                $(".rest-part").addClass('d-none');
            }
        })

        function add_fields() {
          document.getElementById("myTable").insertRow(-1).innerHTML = '<tr><td><input type="date"  placeholder="start day" name="start_day[]" value="" class="form-control" required></td><td><input type="date"  placeholder="end day" name="end_day[]" value="" class="form-control" required></td><td><input type="nubmer" placeholder="Discount" name="discountCam[]" value="" class="form-control" required> </td> </tr>';
        }

    </script>

  <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
      $(document).ready(function() {
  $('#summernote').summernote();
  $('#summernote1').summernote();
  $('#summernote2').summernote();
});
    </script>

    {{-- ck editor --}}

@endpush



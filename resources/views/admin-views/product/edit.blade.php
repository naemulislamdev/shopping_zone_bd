@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product Edit'))

@push('css_or_js')
    <link href="{{ asset('public/assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('admin.dashboard') }}">{{ \App\CPU\translate('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{ route('admin.product.list', ['in_house', '']) }}">{{ \App\CPU\translate('Product') }}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ \App\CPU\translate('Edit') }}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{ route('admin.product.update', $product->id) }}" method="post"
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
                                <?php
                                if (count($product['translations'])) {
                                    $translate = [];
                                    foreach ($product['translations'] as $t) {
                                        if ($t->locale == $lang && $t->key == 'name') {
                                            $translate[$lang]['name'] = $t->value;
                                        }
                                        if ($t->locale == $lang && $t->key == 'description') {
                                            $translate[$lang]['description'] = $t->value;
                                        }
                                    }
                                }
                                ?>
                                <div class="{{ $lang != 'en' ? 'd-none' : '' }} lang_form" id="{{ $lang }}-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="{{ $lang }}_name">{{ \App\CPU\translate('name') }}
                                            ({{ strtoupper($lang) }})
                                            <span class="text-danger">*</span></label>
                                        <input type="text" {{ $lang == 'en' ? 'required' : '' }} name="name[]"
                                            id="{{ $lang }}_name"
                                            value="{{ $translate[$lang]['name'] ?? $product['name'] }}" class="form-control"
                                            placeholder="{{ \App\CPU\translate('New Product') }}" required>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    <div class="form-group">
                                        <label class="input-label">{{ \App\CPU\translate('description') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <textarea rows="10" style="width:400px" type="text" name="description[]" class=" editor" id="summernote">{!! $translate[$lang]['description'] ?? $product['details'] !!}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label">{{ \App\CPU\translate('short description') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <textarea rows="10" style="width:400px" type="text" name="short_description[]" class=" short_description"
                                            id="summernote1">{!! $translate[$lang]['short_description'] ?? $product['short_description'] !!}</textarea>
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
                                        <label for="name">{{ \App\CPU\translate('Category') }} <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="category_id" id="category_id"
                                            onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-category-select','select')">
                                            <option value="0" selected disabled>
                                                ---{{ \App\CPU\translate('Select') }}---</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}"
                                                    {{ $category->id == $product_category[0]->id ? 'selected' : '' }}>
                                                    {{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Sub Category') }}</label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="sub_category_id" id="sub-category-select"
                                            data-id="{{ count($product_category) >= 2 ? $product_category[1]->id : '' }}"
                                            onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-sub-category-select','select')">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Sub Sub Category') }}</label>

                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            data-id="{{ count($product_category) >= 3 ? $product_category[2]->id : '' }}"
                                            name="sub_sub_category_id" id="sub-sub-category-select">

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
                                            <input type="text" id="generate_number" name="code"
                                                class="form-control" value="{{ $product->code }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Brand') }} <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="brand_id">
                                            <option value="{{ null }}" selected disabled>
                                                ---{{ \App\CPU\translate('Select') }}---</option>
                                            @foreach ($br as $b)
                                                <option value="{{ $b['id'] }}"
                                                    {{ $b->id == $product->brand_id ? 'selected' : '' }}>{{ $b['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="name">{{ \App\CPU\translate('Unit') }} <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="unit">
                                            @foreach (\App\CPU\Helpers::units() as $x)
                                                <option value={{ $x }}
                                                    {{ $product->unit == $x ? 'selected' : '' }}>{{ $x }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{ \App\CPU\translate('Variation') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">

                                        <label for="colors">
                                            {{ \App\CPU\translate('Colors') }} :
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" class="status" name="colors_active"
                                                {{ count($product['colors']) > 0 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>

                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="colors[]" multiple="multiple" id="colors-selector"
                                            {{ count($product['colors']) > 0 ? '' : 'disabled' }}>
                                            @foreach (\App\Model\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                <option value={{ $color->code }}
                                                    {{ in_array($color->code, $product['colors']) ? 'selected' : '' }}>
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
                                                @if ($product['attributes'] != 'null')
                                                    <option value="{{ $a['id'] }}"
                                                        {{ in_array($a->id, json_decode($product['attributes'], true)) ? 'selected' : '' }}>
                                                        {{ $a['name'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $a['id'] }}">{{ $a['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="customer_choice_options" id="customer_choice_options">
                                            @include('admin-views.product.partials._choices', [
                                                'choice_no' => json_decode($product['attributes']),
                                                'choice_options' => json_decode($product['choice_options'], true),
                                            ])
                                        </div>
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
                                            class="form-control"
                                            value={{ \App\CPU\Convert::default($product->unit_price) }} required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">{{ \App\CPU\translate('Purchase price') }}</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" min="0" step="0.01"
                                            placeholder="{{ \App\CPU\translate('Purchase price') }}"
                                            name="purchase_price" class="form-control"
                                            value={{ \App\CPU\Convert::default($product->purchase_price) }} required>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label class="control-label">{{ \App\CPU\translate('Tax') }} <span
                                                class="text-danger">*</span></label>
                                        <label class="badge badge-info">{{ \App\CPU\translate('Percent') }} ( % )</label>
                                        <input type="number" min="0" value={{ $product->tax }} step="0.01"
                                            placeholder="{{ \App\CPU\translate('Tax') }}" name="tax"
                                            class="form-control" required>
                                        <input name="tax_type" value="percent" style="display: none">
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <label class="control-label">{{ \App\CPU\translate('Discount') }}</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" min="0"
                                            value={{ $product->discount_type == 'flat' ? \App\CPU\Convert::default($product->discount) : $product->discount }}
                                            step="0.01" placeholder="{{ \App\CPU\translate('Discount') }}"
                                            name="discount" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mt-6">
                                        <select style="width: 100%"
                                            class="js-example-basic-multiple js-states js-example-responsive demo-select2"
                                            name="discount_type">
                                            <option value="percent"
                                                {{ $product['discount_type'] == 'percent' ? 'selected' : '' }}>
                                                {{ \App\CPU\translate('Percent') }}</option>
                                            <option value="flat" {{ $product['discount_type'] == 'flat' ? 'selected' : '' }}>
                                                {{ \App\CPU\translate('Flat') }}</option>

                                        </select>
                                    </div>
                                    <div class="col-12 pt-4 sku_combination" id="sku_combination">
                                        @include('admin-views.product.partials._edit_sku_combinations', [
                                            'combinations' => json_decode($product['variation'], true),
                                        ])
                                    </div>
                                    <div class="col-md-3" id="quantity">
                                        <label class="control-label">{{ \App\CPU\translate('total') }}
                                            {{ \App\CPU\translate('Quantity') }}</label>
                                        <input type="number" min="0" value={{ $product->current_stock }}
                                            step="1" placeholder="{{ \App\CPU\translate('Quantity') }}"
                                            name="current_stock" class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="minimum_order_qty">
                                        <label
                                            class="control-label">{{ \App\CPU\translate('minimum_order_quantity') }}</label>
                                        <input type="number" min="1" value={{ $product->minimum_order_qty }}
                                            step="1"
                                            placeholder="{{ \App\CPU\translate('minimum_order_quantity') }}"
                                            name="minimum_order_qty" class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="shipping_cost">
                                        <label class="control-label">{{ \App\CPU\translate('shipping_cost') }} </label>
                                        <input type="number" min="0"
                                            value="{{ \App\CPU\Convert::default($product->shipping_cost) }}"
                                            step="1" placeholder="{{ \App\CPU\translate('shipping_cost') }}"
                                            name="shipping_cost" class="form-control" required>
                                    </div>
                                    <div class="col-md-3" id="shipping_cost_multy">
                                        <div>
                                            <label
                                                class="control-label">{{ \App\CPU\translate('shipping_cost_multiply_with_quantity') }}
                                            </label>

                                        </div>
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" name="multiplyQTY" id=""
                                                    {{ $product->multiply_qty == 1 ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>Product Campaing Discount</h4>
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
                                    @if (count($campaingDetalies) > 0)

                                        @foreach ($campaingDetalies as $campaing_detalies)
                                            <tr>

                                                <td>

                                                    <input class="form-control" type="date" placeholder="start day"
                                                        name="start_day[]" value="{{ $campaing_detalies->start_day }}"
                                                        required>

                                                </td>
                                                <td>

                                                    <input class="form-control" type="date" placeholder="end day"
                                                        name="end_day[]" value="{{ $campaing_detalies->end_day }}"
                                                        required>

                                                </td>

                                                <td>
                                                    <input type="number" class="form-control" placeholder="Discount"
                                                        name="discountCam[]"
                                                        value="{{ $campaing_detalies->discountCam }}" required>
                                                </td>

                                                <td>
                                                    <a
                                                        href="{{ route('admin.product.CampaingDelete', $campaing_detalies->id) }}">
                                                        <i class="tio-add-to-trash"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="date" placeholder="start day" name="start_day[]"
                                                    value="" class="form-control" required>
                                            </td>
                                            <td>
                                                <input class="form-control" type="date" placeholder="end day"
                                                    name="end_day[]" value="" required>
                                            </td>
                                            <td>
                                                <input type="number" placeholder="Discount" name="discountCam[]"
                                                    value="" class="form-control" required>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                                <div class="set-form">
                                    <input type="button" id="more_fields" onclick="add_fields();" value="Add More"
                                        class="btn btn-info" />
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
                                    <input type="text" name="meta_title" value="{{ $product['meta_title'] }}"
                                        placeholder="" class="form-control">
                                </div>

                                <div class="col-md-8 mb-4">
                                    <label class="control-label">{{ \App\CPU\translate('Meta Description') }}</label>
                                    <textarea rows="10" type="text" name="meta_description" class="form-control" id="summernote2">{{ $product['meta_description'] }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label>{{ \App\CPU\translate('Meta Image') }}</label>
                                    </div>
                                    <div class="border-dashed">
                                        <div class="row" id="meta_img">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img style="width: 100%" height="auto"
                                                            onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                            src="{{ asset('storage/app/public/product/meta') }}/{{ $product['meta_image'] }}"
                                                            alt="Meta image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                    <input type="text" value="{{ $product['video_url'] }}" name="video_link"
                                        placeholder="{{ \App\CPU\translate('EX') }} : https://www.youtube.com/embed/5R06LRdUCSE"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <label class="control-label">{{ \App\CPU\translate('Video shopping') }}
                                        </label>
                                    </div>
                                    <label class="switch">
                                        <input type="checkbox" {{ $product->video_shopping ? 'checked' : '' }}
                                            class="status" value="{{ old('video_shopping') }}" name="video_shopping">
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ \App\CPU\translate('Upload product images') }}</label><small
                                            style="color: red">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</small>
                                    </div>
                                    <div class="p-2 border border-dashed" style="max-width:430px;">
                                        <div class="row" id="coba">
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body">

                                                            <img style="width: 100%" height="auto"
                                                                onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                                src="{{ asset("storage/app/public/product/$photo") }}"
                                                                alt="Product image">
                                                            <input type="text" disabled
                                                                value="{{ asset("storage/app/public/product/$photo") }}"
                                                                id="image-{{ $key }}">

                                                            <div class="d-flex">
                                                                <a href="{{ route('admin.product.remove-image', ['id' => $product['id'], 'name' => $photo]) }}"
                                                                    class="btn btn-danger btn-xs m-1">{{ \App\CPU\translate('Remove') }}</a>

                                                                <a class="btn btn-info btn-xs m-1"
                                                                    href="javascript:void(0);"
                                                                    onclick="copyImageUrl({{ $key }});">Copy
                                                                    URL</a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Size Chart</label><small style="color: red"> (
                                            {{ \App\CPU\translate('ratio') }} 1:1 )</small>
                                    </div>

                                    <div class="row" id="size_chart">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img style="width: 100%" height="auto"
                                                        onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                        src="{{ asset('storage/app/public/product/thumbnail') }}/{{ $product['size_chart'] }}"
                                                        alt="Product Size Chart image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">{{ \App\CPU\translate('Upload thumbnail') }}</label><small
                                            style="color: red">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</small>
                                    </div>

                                    <div class="row" id="thumbnail">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img style="width: 100%" height="auto"
                                                        onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                                        src="{{ asset('storage/app/public/product/thumbnail') }}/{{ $product['thumbnail'] }}"
                                                        alt="Product image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                @if ($product->request_status == 2)
                                    <button type="button" onclick="check()"
                                        class="btn btn-primary">{{ \App\CPU\translate('Update & Publish') }}</button>
                                @else
                                    <button type="button" onclick="check()"
                                        class="btn btn-primary float-right">{{ \App\CPU\translate('Update') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        var imageCount = {{ 10 - count(json_decode($product->images)) }};
        var thumbnail =
            '{{ \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product->thumbnail ?? asset('public/assets/back-end/img/400x400/img2.jpg') }}';
        var size_chart =
            '{{ \App\CPU\ProductManager::product_image_path('size_chart') . '/' . $product->size_chart ?? asset('public/assets/back-end/img/400x400/img2.jpg') }}';
        $(function() {
            if (imageCount > 0) {
                $("#coba").spartanMultiImagePicker({
                    fieldName: 'images[]',
                    maxCount: imageCount,
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
            }

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-3',
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
                groupClassName: 'col-3',
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
            width: 'resolve'
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
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
                '" placeholder="{{ \App\CPU\translate('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="{{ \App\CPU\translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>'
                );
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        setTimeout(function() {
            $('.call-update-sku').on('change', function() {
                update_sku();
            });
        }, 2000)

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
                    update_qty();
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function() {
            setTimeout(function() {
                let category = $("#category_id").val();
                let sub_category = $("#sub-category-select").attr("data-id");
                let sub_sub_category = $("#sub-sub-category-select").attr("data-id");
                getRequest('{{ url('/') }}/admin/product/get-categories?parent_id=' + category +
                    '&sub_category=' + sub_category, 'sub-category-select', 'select');
                getRequest('{{ url('/') }}/admin/product/get-categories?parent_id=' + sub_category +
                    '&sub_category=' + sub_sub_category, 'sub-sub-category-select', 'select');
            }, 100)
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

            var formData = new FormData(document.getElementById('product_form'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.product.update', $product->id) }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('product updated successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        $('#product_form').submit();
                    }
                }
            });
        };

        function add_fields() {
            document.getElementById("myTable").insertRow(-1).innerHTML =
                '<tr><td><input type="date"  placeholder="start day" name="start_day[]" value="" class="form-control" required></td><td><input type="date"  placeholder="end day" name="end_day[]" value="" class="form-control" required></td><td><input type="nubmer" placeholder="Discount" name="discountCam[]" value="" class="form-control" required> </td> </tr>';
        }
    </script>

    <script>
        update_qty();

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if (qty_elements.length > 0) {

                $('input[name="current_stock"]').attr("readonly", true);
                $('input[name="current_stock"]').val(total_qty);
            } else {
                $('input[name="current_stock"]').attr("readonly", false);
            }
        }

        $('input[name^="qty_"]').on('keyup', function() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            $('input[name="current_stock"]').val(total_qty);
        });
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
    </script>
    <script>
        function copyImageUrl(id) {
            var copyText = document.getElementById("image-" + id);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            //alert("Copied the text: " + copyText.value);

            Swal.fire({
                title: "Copied the image URL",
                showCancelButton: false,
                confirmButtonColor: '#377dff',
                cancelButtonColor: 'secondary',
                confirmButtonText: 'Ok'
            })
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

@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Landing Pages'))

@push('css_or_js')
    <link href="{{asset('public/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('Landing Pages Add')}}</li>
            <li class="breadcrumb-item">{{\App\CPU\translate('Add new')}}</li>
        </ol>
    </nav>

    <!-- Content Row -->
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ \App\CPU\translate('Landing-pages_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.landingpages.landing')}}" method="post" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};" enctype="multipart/form-data">
                        @csrf
                        @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                        @php($language = $language->value ?? null)
                        @php($default_lang = 'en')

                        @php($default_lang = json_decode($language)[0])
                        <ul class="nav nav-tabs mb-4">
                            @foreach(json_decode($language) as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}"
                                       href="#"
                                       id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="form-group">
                            @foreach(json_decode($language) as $lang)
                                <div class="row {{$lang != $default_lang ? 'd-none':''}} lang_form" id="{{$lang}}-form">
                                    <input type="text" name="deal_type" value="flash_deal"  class="d-none">
                                    <div class="col-md-12">
                                        <label for="name">{{ \App\CPU\translate('Title')}} ({{strtoupper($lang)}})</label>
                                        <input type="text" name="title[]" class="form-control" id="title"
                                               placeholder="{{\App\CPU\translate('Ex')}} : {{\App\CPU\translate('LUX')}}"
                                               {{$lang == $default_lang? 'required':''}}>
                                    </div>
                                </div>
                                <input type="hidden" name="lang[]" value="{{$lang}}" id="lang">
                            @endforeach
                            

                            <div class="row">
                                <div class="col-md-12" style="padding-top: 20px;">
                                    <label for="name">{{\App\CPU\translate('Main')}} {{\App\CPU\translate('Banner')}}</label><span class="badge badge-soft-danger">( {{\App\CPU\translate('ratio')}} 5:1 )</span>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div style="text-align:center;">
                                        <img style="width:70%;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="{{asset('public\assets\back-end\img\1920x400\img1.jpg')}}" alt="banner image"/>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="row">
                                <div class="col-md-12" style="padding-top: 20px;">
                                    <label for="name">{{\App\CPU\translate('Mid')}} {{\App\CPU\translate('Banner')}}</label><span class="badge badge-soft-danger">( {{\App\CPU\translate('ratio')}} 5:1 )</span>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image1" id="customFileUpload1" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload1">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div style="text-align:center;">
                                        <img style="width:70%;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer1"
                                            src="{{asset('public\assets\back-end\img\1920x400\img1.jpg')}}" alt="banner image"/>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class=" pl-0">
                            <button type="submit"
                                    class="btn btn-primary float-right">{{ \App\CPU\translate('save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="flex-between row justify-content-between align-items-center flex-grow-1 mx-1">
                        <div class="flex-between">
                            <div><h5>{{ \App\CPU\translate('Landing pages table')}}</h5></div>

                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable"
                               style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{ \App\CPU\translate('Title')}}</th>
                                <th>{{ \App\CPU\translate('Slug')}}</th>
                                <th>{{ \App\CPU\translate('status')}}</th>
                                <th>{{ \App\CPU\translate('Product Add')}}</th>
                                <th style="width: 50px">{{ \App\CPU\translate('action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($landing_page as $k=>$deal)
                            
                                <tr>
                                    
                                    <td>{{$deal->title}}</td>
                                    <td>{{$deal->slug}}</td>
                                    
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="{{$deal->id}}" {{$deal->status == 1?'checked':''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                         <a href="{{route('admin.landingpages.add-product',$deal->id)}}"
                                           class="btn btn-primary btn-sm">
                                            {{\App\CPU\translate('Add Product')}}
                                        </a>
                                    </td>
                                    <td>
                                        <a  title="{{\App\CPU\translate('Edit')}}"
                                            href="{{route('admin.landingpages.update',$deal->id)}}"
                                            class="btn btn-primary btn-sm edit">
                                            <i class="tio-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

               
                @if(count($landing_page)==0)
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->

    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
     <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });
        
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload1").change(function () {
            readURL1(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        
        
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.landingpages.status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('{{\App\CPU\translate('Status updated successfully')}}');
                    location.reload();
                }
            });
        });

    </script>
    
@endpush

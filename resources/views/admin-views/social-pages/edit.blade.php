@extends('layouts.back-end.app')

@section('title', "Edit Social Page")

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid main-card rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{\App\CPU\translate('Dashboard')}}</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Edit Social Page</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body ">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center mb-2 ">
                                    <h3 class="" > Social Page Create</h3>
                                    <hr>
                                </div>
                                <form class="user" action="{{route('admin.social-page.update',[$b['id']])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$b->id}}">
                                    <h5 class="black">Social Page {{\App\CPU\translate('Info')}} </h5>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-sm-0">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control form-control-user" id="exampleFirstName" name="name" value="{{$b->name}}" placeholder="Social Page Name" required>
                                        </div>
                                        <div class="col-sm-6 mb-sm-0">
                                            <label for="link">Social Page Link</label>
                                            <input type="text" class="form-control form-control-user" id="exampleInputLink" name="link" value="{{$b->link}}" placeholder="Social Page Link" required>
                                        </div>

                                        <div class="col-sm-4  mb-sm-0">
                                            <label for="name">Branch Status</label>
                                            <select class="form-control" name="status"
                                                    style="width: 100%">
                                                <option selected disabled>---{{\App\CPU\translate('select')}}---</option>
                                                <option value="0" @if($b->status==0) selected @endif>Inactive</option>
                                                <option value="1" @if($b->status==1) selected @endif>Active</option>

                                            </select>
                                        </div>
                                    </div>



                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">Save </button>
                                </form>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>







</script>
@endpush

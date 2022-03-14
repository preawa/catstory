@extends('layouts.backend.app')

@section('title', 'Forms')

    @push('css')
        <!-- Bootstrap Select Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
        {{--
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        --}}
        <style>
            .label {
                font-weight: 400;
                padding: 4px 8px;
                font-size: 11px;
                display: inline-block;
                line-height: 1;
                color: #000000;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.25em;
            }

        </style>
    @endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn btn-danger waves-effect" href="{{ route('admin.form.index') }}">
                <span>Back</span>
            </a>
        </div>
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.form.update',$form->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT FORMS
                            </h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="form-line">
                                    <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                                    <input type="text" class="form-control" name="name" value="{{ $form->name }}" placeholder="Name">
                                </div>
                                <div class="form-line">
                                    <label for="exampleInputEmail2">อีเมลล์</label>
                                    <input type="email" class="form-control" name="email" value="{{ $form->email }}" placeholder="Email">
                                </div>
                                <div class="form-line">
                                    <label for="exampleInputPassword1">เบอร์โทร</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $form->phone }}" placeholder="Phone">
                                </div>
                                <div class="form-line">
                                    <label for="exampleInputEmail3">ที่อยู่</label>
                                    <input type="text" class="form-control" name="address" value="{{ $form->address }}" placeholder="Address">
                                </div>
                                <div class="form-line">
                                    <label for="exampleInputEmail4">เหตุผลที่รับเลี้ยง</label>
                                    <textarea type="text" class="form-control" name="descript"
                                        placeholder="Descript">{{ $form->descript }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function() {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('
            assets / backend / plugins / tinymce ') }}';
        });

    </script>

@endpush

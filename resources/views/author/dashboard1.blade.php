@extends('layouts.frontend.app')

@section('title', 'Dashboard')

@push('css')
    <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">

    <style>
        img.1 {
            height: 150px;
            width: 100%;
        }

        div.1 [class^="col-"] {
            padding-left: 5px;
            padding-right: 5px;
        }

        .card {
            height: auto;
            width: 100%;
            background: rgb(158, 157, 157);
            transition: 0.5s;
            cursor: pointer;
        }

        .card-title {
            font-size: 15px;
            transition: 1s;
            cursor: pointer;
        }

        .card-title i {
            font-size: 15px;
            transition: 1s;
            cursor: pointer;
            color: #000000
        }

        /* .card-title i:hover {
                            transform: scale(1.25) rotate(100deg);
                            color: #18d4ca;

                        } */

        /* .card:hover {
                            transform: scale(1.05);
                            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
                        } */

        .card-text {
            height: 80px;
        }

        /* .card::before,
                        .card::after {
                            position: absolute;
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0;
                            transform: scale3d(0, 0, 1);
                            transition: transform .3s ease-out 0s;
                            background: rgba(51, 50, 50, 0.1);
                            content: '';
                            pointer-events: none;
                        } */

        /* .card::before {
                            transform-origin: left top;
                        }

                        .card::after {
                            transform-origin: right bottom;
                        }

                        .card:hover::before,
                        .card:hover::after,
                        .card:focus::before,
                        .card:focus::after {
                            transform: scale3d(1, 1, 1);
                        } */

        body {
            background-color: #dfdbdb;
        }

        .favorite_posts {
            color: blue;
        }

        .user-profile-image1 {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .card1.card-white {
            background-color: #bebdbd;
            border: 1px solid transparent;
            border-radius: 4px;
            box-shadow: 0 0.05rem 0.01rem rgba(75, 75, 90, 0.075);
            padding: 10px;
        }

        .grid-margin {
            margin-bottom: 2rem;
        }

        .profile-timeline ul li .timeline-item-header {
            width: 100%;
            overflow: hidden;
        }

        .profile-timeline ul li .timeline-item-header img {
            width: 40px;
            height: 40px;
            float: left;
            margin-right: 10px;
            border-radius: 50%;
        }

        .profile-timeline ul li .timeline-item-header p {
            margin: 0;
            color: #000;
            font-weight: 500;
        }

        .profile-timeline ul li .timeline-item-header p span {
            margin: 0;
            color: #8e8e8e;
            font-weight: normal;
        }

        .profile-timeline ul li .timeline-item-header small {
            margin: 0;
            color: #8e8e8e;
        }

        .profile-timeline ul li .timeline-item-post {
            padding: 20px 0 0 0;
            position: relative;
        }

        .profile-timeline ul li .timeline-item-post>img {
            width: 100%;
        }

        .timeline-options {
            overflow: hidden;
            margin-top: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f1f1;
            padding: 10px 0 10px 0;
        }

        .timeline-options a {
            display: block;
            margin-right: 20px;
            float: left;
            color: #4b4b4b;
            text-decoration: none;
        }

        .timeline-options a i {
            margin-right: 3px;
        }

        .timeline-options a:hover {
            color: #5369f8;
        }

        .timeline-comment {
            overflow: hidden;
            margin-bottom: 10px;
            width: 100%;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 5px;
        }

        .timeline-comment .timeline-comment-header {
            overflow: hidden;
        }

        .timeline-comment .timeline-comment-header img {
            width: 30px;
            border-radius: 50%;
            float: left;
            margin-right: 10px;
        }

        .timeline-comment .timeline-comment-header p {
            color: #000;
            float: left;
            margin: 0;
            font-weight: 500;
        }

        .timeline-comment .timeline-comment-header small {
            font-weight: normal;
            color: #8e8e8e;
        }

        .timeline-comment p.timeline-comment-text {
            display: block;
            color: #dddddd;
            font-size: 14px;
            padding-left: 40px;
        }

        .post-options {
            overflow: hidden;
            margin-top: 15px;
            margin-left: 15px;
        }

        .post-options a {
            display: block;
            margin-top: 5px;
            margin-right: 20px;
            float: left;
            color: #dddddd;
            text-decoration: none;
            font-size: 16px !important;
        }

        .post-options a:hover {
            color: #5369f8;
        }

        .online {
            position: absolute;
            top: 2px;
            right: 2px;
            display: block;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #ccc;
        }

        .online.on {
            background: #2ec5d3;
        }

        .online.off {
            background: #ec5e69;
        }

        #cd-timeline::before {
            border: 0;
            background: #f1f1f1;
        }

        .cd-timeline-content p,
        .cd-timeline-content .cd-read-more,
        .cd-timeline-content .cd-date {
            font-size: 14px;
        }

        .cd-timeline-img.cd-success {
            background: #2ec5d3;
        }

        .cd-timeline-img.cd-danger {
            background: #ec5e69;
        }

        .cd-timeline-img.cd-info {
            background: #5893df;
        }

        .cd-timeline-img.cd-warning {
            background: #f1c205;
        }

        .cd-timeline-img.cd-primary {
            background: #9f7ce1;
        }

        .page-inner.full-page {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
        }

        .user-profile-card {
            text-align: center;
        }

        .user-profile-image {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .team .team-member {
            display: block;
            overflow: hidden;
            margin-bottom: 10px;
            float: left;
            position: relative;
        }

        .team .team-member .online {
            top: 5px;
            right: 5px;
        }

        .team .team-member img {
            width: 40px;
            float: left;
            border-radius: 50%;
            margin: 0 5px 0 5px;
        }

        .label.label-success {
            background: #43d39e;
        }

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

        /* .text-white {
                                                        color: rgb(0, 0, 0) !important;
                                                    } */

        .ui-bg-overlay-container,
        .ui-bg-video-container {
            position: relative;
        }

        .ui-bg-cover {
            background-color: transparent;
            background-position: center center;
            background-size: cover;
        }

        .ui-bg-overlay-container .ui-bg-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: block;
        }

        .bg-dark {
            background-color: rgba(255, 255, 255, 0.9) !important;
        }

        .opacity-50 {
            opacity: .5 !important;
        }

        .ui-bg-overlay-container>*,
        .ui-bg-video-container>* {
            position: relative;
        }

        @media (min-width: 992px) {

            .container,
            .container-fluid {
                padding-right: 2rem;
                padding-left: 2rem;
            }
        }

        .media,
        .media>:not(.media-body),
        .jumbotron,
        .card {
            -ms-flex-negative: 1;
            flex-shrink: 1;
        }

        .d-flex,
        .d-inline-flex,
        .media,
        .media>:not(.media-body),
        .jumbotron,
        .card {
            -ms-flex-negative: 1;
            flex-shrink: 1;
        }

        .ui-w-100 {
            width: 100px !important;
            height: auto;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .opacity-75 {
            opacity: .75 !important;
        }

        .tabs-alt.nav-tabs .nav-link.active,
        .tabs-alt.nav-tabs .nav-link.active:hover,
        .tabs-alt.nav-tabs .nav-link.active:focus,
        .tabs-alt>.nav-tabs .nav-link.active,
        .tabs-alt>.nav-tabs .nav-link.active:hover,
        .tabs-alt>.nav-tabs .nav-link.active:focus {
            -webkit-box-shadow: 0 -2px 0 #d3c0ac inset;
            box-shadow: 0 -2px 0 #d3c0ac inset;
        }

        .nav-tabs:not(.nav-fill):not(.nav-justified) .nav-link,
        .nav-pills:not(.nav-fill):not(.nav-justified) .nav-link {
            margin-right: .125rem;
        }

        .nav-tabs.tabs-alt .nav-link,
        .tabs-alt>.nav-tabs .nav-link {
            border-width: 0 !important;
            border-radius: 0 !important;
            background-color: transparent !important;
        }

        .nav-tabs .nav-link.active {
            border-bottom-color: rgb(197, 197, 197);
        }

        .tab-pane {
            padding-top: 20px;
            /* background-color: #ffffff; */
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* .user-profile-content{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                background-color: #ffffff;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        /* ===========
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           Gallery
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         =============*/
        .portfolioFilter a {
            -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            -moz-transition: all 0.3s ease-out;
            -ms-transition: all 0.3s ease-out;
            -o-transition: all 0.3s ease-out;
            -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 0.3s ease-out;
            box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            color: #333333;
            padding: 5px 10px;
            display: inline-block;
            transition: all 0.3s ease-out;
        }

        .portfolioFilter a:hover {
            background-color: #228bdf;
            color: #ffffff;
        }

        .portfolioFilter a.current {
            background-color: #228bdf;
            color: #ffffff;
        }

        .thumb {
            background-color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            width: 100%;
        }

        .thumb-img {
            border-radius: 2px;
            overflow: hidden;
            width: 100%;
        }

        .gal-detail h4 {
            margin: 16px auto 10px auto;
            width: 80%;
            white-space: nowrap;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .gal-detail .ga-border {
            height: 3px;
            width: 40px;
            background-color: #228bdf;
            margin: 10px auto;
        }

    </style>
@endpush

@section('content')
    <div class="dashboard-head">
        <div class="container">
            <div class="text-center py-5">
                {{-- <img src="{{ asset('assets/frontend/images/userprofilemock.png') }}" class="user-profile-image rounded-circle" alt="" /> --}}
                <img src="{{ asset('storage/profile/' . Auth::user()->image) }}" alt class="ui-w-100 rounded-circle">
                <div class="text-muted mb-4">
                    <h4 class="text-center h6 mt-2">{{ Auth::user()->name }}</h4>
                    <h4 class="text-center h6 mt-2">{{ Auth::user()->email }}</h4>
                    <a class="d-inline-block text-dark ml-3">
                        <strong>{{ $posts->count() }}</strong>
                        <h6> posts</h6>
                    </a>
                    <a class="d-inline-block text-dark ml-3">
                        <strong>{{ Auth::user()->favorite_posts()->count() }}</strong>
                        <h6>favorite</h6>
                    </a>
                    <a class="d-inline-block text-dark ml-3">
                        <strong>{{ $total_pending_posts }}</strong>
                        <h6>pending</h6>
                    </a>
                    <a class="d-inline-block text-dark ml-3">
                        <strong>{{ $all_views }}</strong>
                        <h6>views</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr class="m-0">
    <div class="widget widget-tabbed ">
        <!-- Nav tab -->
        <ul
            class="nav nav-tabs tabs-alt justify-content-center text-white tab-profile bg-color2 text-center d-block d-sm-flex">
            <li class="nav-item">
                <a class="nav-link py-4" href="#post" data-toggle="tab"><i class="material-icons">article</i>
                    Posts</a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4 active" href="#owner" data-toggle="tab"><i
                        class="material-icons">person_pin</i>Cats
                    Owner</a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#gallary" data-toggle="tab"><i class="material-icons">collections</i>
                    Gallarys</a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="#setting" data-toggle="tab"><i class="material-icons">settings</i>
                    Settings</a>
            </li>

            <li class="nav-item">
                <a class="nav-link py-4" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();"
                    data-toggle="tab">
                    <i class="material-icons">input</i> LogOut
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- End nav tab -->

        <!-- Tab panes -->
        <div class="tab-content">

            <!-- Tab Posts -->
            <div class="tab-pane animated active fadeInRight" id="my-post">
                <div class="user-profile-content">
                    <div class="container">
                        <div class="user-profile-content">
                            <div class="block-header">
                                <a class="btn btn-first waves-effect d-flex w-120  mb-3"
                                    href="{{ route('author.catowner.create') }}">
                                    <i class="material-icons">person_pin</i>Add Cats</a>
                            </div>
                            <!-- Exportable Table -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block">
                                    <div class="card">
                                        <div class="header">
                                            <h5 class="h5">
                                                ALL Form Cats
                                            </h5>
                                        </div>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Author</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                            <th>Is Approved</th>
                                                            <th>Created At</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($cats as $key => $cat)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ str_limit($cat->name, '10') }}</td>
                                                                <td>{{ $cat->user->name }}</td>
                                                                <td>{{ $cat->body }}</td>
                                                                <td>
                                                                    @if ($cat->status == true)
                                                                        <strong>มีเจ้าของ</strong>
                                                                    @else
                                                                        <strong>ไม่มีเจ้าของ</strong>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($cat->is_approved == true)
                                                                        <strong>Approved</strong>
                                                                    @else
                                                                        <strong>Pending</strong>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $cat->created_at }}</td>

                                                                <td class="text-center">

                                                                    <a href="{{ route('author.catowner.show', $cat->id) }}"
                                                                        class="btn btn-success waves-effect">
                                                                        <i class="material-icons">visibility</i>
                                                                    </a>
                                                                    {{-- <button class="btn btn-success waves-effect"
                                                                        type="button">
                                                                        <i class="material-icons">edit</i>
                                                                    </button> --}}
                                                                    {{-- <div class="timeline-item-header">
                                                                        <div class="modal fade" id="exampleModalCenter3"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalCenterTitle"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="h5">
                                                                                            EDIT POST
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <i
                                                                                                class="material-icons">close</i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form
                                                                                            action="{{ route('author.post.update', $post->id) }}"
                                                                                            method="POST"
                                                                                            enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="row clearfix">
                                                                                                <div class="col-md-12 ">
                                                                                                    <div
                                                                                                        class="card">

                                                                                                        <div
                                                                                                            class="body">
                                                                                                            <div
                                                                                                                class="form-group form-float">
                                                                                                                <label
                                                                                                                    for="">Topic</label>
                                                                                                                <div
                                                                                                                    class="form-line">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="title"
                                                                                                                        class="form-control mt-0"
                                                                                                                        name="title"
                                                                                                                        value="{{ $post->title }}">

                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div
                                                                                                                class="form-group">
                                                                                                                <label
                                                                                                                    for="image">Featured
                                                                                                                    Image</label>
                                                                                                                <br>
                                                                                                                <input
                                                                                                                    type="file"
                                                                                                                    name="image"
                                                                                                                    multiple>
                                                                                                            </div>


                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> --}}


                                                                    
                                                                    
                                                                    
                                                                    <button class="btn btn-danger waves-effect"
                                                                        type="button"
                                                                        onclick="deleteCatowner({{ $cat->id }})">
                                                                        <i class="material-icons">delete</i>
                                                                    </button>
                                                                    <form id="delete-form-{{ $cat->id }}"
                                                                        action="{{ route('author.catowner.destroy', $cat->id) }}"
                                                                        method="POST" style="display: none;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $catss->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #END# Exportable Table -->
                        </div>
                    </div>
                </div><!-- End div .user-profile-content -->
                {{-- {{ $posts->links() }} --}}
            </div><!-- End div .tab-pane -->
            <!-- End Tab timeline -->

        </div>
        <!-- #END# Exportable Table -->
    </div>
    </div><!-- End div .scroll-user-widget -->
    </div><!-- End div .tab-pane -->
    <!-- End Tab user messages -->
    </div><!-- End div .tab-content -->
    </ul><!-- End div .box-info -->



    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}">
    </script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
    <script type="text/javascript">
        function deleteMap(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
    <script type="text/javascript">
        function deleteCatowner(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                     document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
        
       
    </script>


    {{-- javascript code --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initAutocomplete"
        type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
    <script>
        $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
        });
    </script>


    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var options = {
                componentRestrictions: {
                    country: "TH"
                }
            };

            var input = document.getElementById('address_address');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                // --------- show lat and long ---------------
                $("#lat_area").removeClass("d-none");
                $("#long_area").removeClass("d-none");
            });

        }
    </script>


@endpush

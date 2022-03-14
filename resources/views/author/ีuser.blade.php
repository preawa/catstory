@extends('layouts.frontend.app')

@section('title', 'Dashboard')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">

        <!-- Bootstrap Select Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
        <!-- Custom Css -->
        <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
            type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

        <style>
            .favorite_posts {
                color: blue;
            }

            .user-profile-image1 {
                width: 50px;
                height: 50px;
                margin-bottom: 10px;
            }

            .card.card-white {
                background-color: #fff;
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
                color: #2b2b2b;
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
                color: #2b2b2b;
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
                color: #2b2b2b;
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
                color: #fff;
                text-align: center;
                white-space: nowrap;
                vertical-align: baseline;
                border-radius: 0.25em;
            }

        </style>
    @endpush

@section('content')
    <br>
    <div class="container">
        <div class="page-inner no-page-title">
            <!-- start page main wrapper -->
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-xl-3">
                        <div class="card card-white grid-margin">
                            <div class="card-heading clearfix">
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-body user-profile-card mb-3">
                                <img src="{{ asset('storage/profile/' . Auth::user()->image) }}"
                                    class="user-profile-image rounded-circle" alt="" />
                                <h4 class="text-center h6 mt-2">{{ Auth::user()->name }}</h4>
                                <h4 class="text-center h6 mt-2">{{ Auth::user()->email }}</h4>
                            </div>
                            <hr />
                            {{-- <div class="card-heading clearfix mt-3">
                                <h4 class="card-title">About</h4>
                            </div>
                            <div class="card-body mb-3">

                            </div>
                            <hr /> --}}
                            {{-- <div class="card-heading clearfix mt-3">
                                <h4 class="card-title">Contact Information</h4>
                            </div>
                            <div class="card-body">
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="card card-white grid-margin">
                            <div class="card-body">
                                <div class="post">
                                    <div class="post-options">
                                        <a href="#">
                                            <img src="{{ asset('storage/profile/' . Auth::user()->image) }}"
                                                class="user-profile-image rounded-circle" alt="" />
                                        </a>
                                        {{-- <a href="#"><i class="fa fa-camera"></i></a>
                                        --}}
                                        <br>
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-primary active float-right" data-toggle="modal"
                                            data-target="#exampleModalCenter">Post</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('author.post.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="header">
                                                            <h2>
                                                                ADD NEW POST
                                                            </h2>
                                                        </div>
                                                        <div class="body">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <textarea type="text" id="title" class="form-control"
                                                                        name="title" placeholder="Post Title"
                                                                        aria-required="true"
                                                                        aria-invalid="false"></textarea>

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Featured Image</label>
                                                                <br>
                                                                <input type="file" name="image">
                                                            </div>

                                                            <div class="form-group">
                                                                <input type="checkbox" id="publish" class="filled-in"
                                                                    name="status" value="1">
                                                                <label for="publish">Publish</label>
                                                            </div>

                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                @if ($post->is_approved == true)
                                    @if ($post->status == true)
                                        <div class="card">
                                            <div class="profile-timeline">
                                                <ul class="list-unstyled">
                                                    <li class="timeline-item">
                                                        <div class="card card-white grid-margin">
                                                            <div class="card-body">

                                                                <div class="timeline-item-header">
                                                                    <a class="avatar" href="#"><img
                                                                            src="{{ asset('storage/profile') }}/{{ $post->user->image }}"
                                                                            alt="Profile Image"></a>

                                                                    <ul class="header-dropdown-menu right">
                                                                        <li class="dropdown">
                                                                            <a href="#" class="dropdown-item"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModalCenter3"
                                                                                role="button" aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                                <i class="material-icons">more_vert</i>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="modal fade" id="exampleModalCenter3"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalCenterTitle"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">

                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true">×</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div role="modalpanel"
                                                                                        class="dropdown-item">
                                                                                        <form
                                                                                            action="{{ route('author.post.update', $post->id) }}"
                                                                                            method="POST"
                                                                                            enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="header">
                                                                                                <h2>
                                                                                                    EDIT POST
                                                                                                </h2>
                                                                                            </div>
                                                                                            <div class="body">
                                                                                                <div
                                                                                                    class="form-group form-float">
                                                                                                    <div class="form-line">
                                                                                                        <input type="text"
                                                                                                            id="title"
                                                                                                            class="form-control"
                                                                                                            name="title"
                                                                                                            value="{{ $post->title }}">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="image">Featured
                                                                                                        Image</label>
                                                                                                    <br>
                                                                                                    <input type="file"
                                                                                                        name="image">
                                                                                                </div>

                                                                                                <div class="form-group">
                                                                                                    <input type="checkbox"
                                                                                                        id="publish"
                                                                                                        class="filled-in"
                                                                                                        name="status"
                                                                                                        value="1"
                                                                                                        {{ $post->status == true ? 'checked' : '' }}>
                                                                                                    <label
                                                                                                        for="publish">Publish</label>
                                                                                                </div>

                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                                                                            </div>
                                                                                        </form>
                                                                                        <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $post->id }})">
                                                                                            <i class="material-icons">delete</i>
                                                                                        </button>
                                                                                        <form id="delete-form-{{ $post->id }}" action="{{ route('author.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a class="name"
                                                                        href="{{ route('author.profile', $post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                                                    <small>{{ $post->created_at->diffForHumans() }}</small>
                                                                </div>

                                                                <div class="timeline-item-post">
                                                                    <div class="para">
                                                                        {!! html_entity_decode($post->title) !!}
                                                                    </div>

                                                                    <div class="blog-image1"><img
                                                                            src="{{ asset('storage/post') }}/{{ $post->image }}"
                                                                            alt="{{ $post->title }}"></div>

                                                                    <div class="timeline-options">
                                                                        @guest
                                                                            <a href="javascript:void(0);"
                                                                                onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                                                                                                                                                                                                                    closeButton: true,
                                                                                                                                                                                                                                                    progressBar: true,
                                                                                                                                                                                                                                                })"><i
                                                                                    class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                                        @else
                                                                            <a href="javascript:void(0);"
                                                                                onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                                                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0
                                                                                            ? 'favorite_posts'
                                                                                            : '' }}"><i class="ion-heart"></i>
                                                                                Like
                                                                                {{ $post->favorite_to_users->count() }}</a>

                                                                            <form id="favorite-form-{{ $post->id }}"
                                                                                method="POST"
                                                                                action="{{ route('post.favorite', $post->id) }}"
                                                                                style="display: none;">
                                                                                @csrf
                                                                            </form>
                                                                        @endguest
                                                                        <a href="#"><i class="ion-chatbubble"></i> Comment
                                                                            {{ $post->comments->count() }}</a>
                                                                        <a href="#"><i class="ion-eye"></i>View
                                                                            {{ $post->view_count }}</a>
                                                                    </div>
                                                                    <!-- Comment -->
                                                                    @if ($post->comments->count() > 0)
                                                                        @foreach ($post->comments as $comment)
                                                                            <div class="timeline-comment">
                                                                                <div class="timeline-comment-header">
                                                                                    <img src="{{ asset('storage/profile') }}/{{ $comment->user->image }}"
                                                                                        alt="Profile Image">
                                                                                    <h4 class="text h6 mt-2">
                                                                                        {{ $comment->user->name }}
                                                                                    </h4>
                                                                                    <small>{{ $comment->created_at->diffForHumans() }}</small>

                                                                                </div>
                                                                                <p class="timeline-comment-text">
                                                                                    {{ $comment->comment }}
                                                                                </p>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    <div class="comment-form">
                                                                        @guest
                                                                            <p>For post a new comment. You need to login first.
                                                                                <a href="{{ route('login') }}">Login</a>
                                                                            </p>
                                                                        @else
                                                                            <form method="post"
                                                                                action="{{ route('comment.store', $post->id) }}">
                                                                                @csrf
                                                                                <div class="post-options">
                                                                                    <div class="col-sm-12">
                                                                                        <input name="comment"
                                                                                            class="text-area-messge form-control"
                                                                                            placeholder="Enter your comment"
                                                                                            aria-required="true"
                                                                                            aria-invalid="false">
                                                                                        <br>
                                                                                        <button
                                                                                            class="btn btn-primary active float-right">Comment</button>
                                                                                    </div><!-- col-sm-12 -->
                                                                                </div>
                                                                            </form>
                                                                        @endguest
                                                                    </div><!-- comment-form -->
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="col-lg-12 col-xl-3">
                        <div class="card card-white grid-margin">
                            <div class="card-heading clearfix">
                                <h4 class="card-title">Settings</h4>
                                <ul>
                                    <li class="">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                                      document.getElementById('logout-form').submit();">
                                            <i class="material-icons">input</i>
                                            <span>LogOut</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                <div class="btn-group dropright">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Settings
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" data-toggle="modal"
                                            data-target="#exampleModalCenter1"><i class="material-icons">face</i> Update
                                            Profile</button>
                                        <button class="dropdown-item" data-toggle="modal"
                                            data-target="#exampleModalCenter2"><i class="material-icons">change_history</i>
                                            Change Password</button>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li role="document" class="active">
                                                        <a href="#" data-toggle="modal">
                                                            <i class="material-icons">face</i> UPDATE PROFILE
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div role="modalpanel" class="dropdown-item">
                                                    <form method="POST" action="{{ route('author.profile.update') }}"
                                                        class="form-horizontal" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row clearfix">
                                                            <label for="name">Name : </label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="name" class="form-control"
                                                                        placeholder="Enter your name" name="name"
                                                                        value="{{ Auth::user()->name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row clearfix">
                                                            <label for="email_address_2">Email :</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="email_address_2"
                                                                        class="form-control"
                                                                        placeholder="Enter your email address" name="email"
                                                                        value="{{ Auth::user()->email }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row clearfix">
                                                            <label for="email_address_2">Image :</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="file" name="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row clearfix">
                                                            <label for="email_address_2">About :</label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <textarea rows="5" name="about"
                                                                        class="form-control">{{ Auth::user()->about }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li role="document">
                                                        <a href="#" data-toggle="modal">
                                                            <i class="material-icons">change_history</i> CHANGE PASSWORD
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div role="modalpanel" class="dropdown-item">
                                                    <form method="POST" action="{{ route('author.password.update') }}"
                                                        class="form-horizontal">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row clearfix">
                                                            <label for="old_password">Old Password : </label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="password" id="old_password"
                                                                        class="form-control"
                                                                        placeholder="Enter your old password"
                                                                        name="old_password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <label for="password">New Password : </label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="password" id="password"
                                                                        class="form-control"
                                                                        placeholder="Enter your new password"
                                                                        name="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <label for="confirm_password">Confirm Password : </label>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="password" id="confirm_password"
                                                                        class="form-control"
                                                                        placeholder="Enter your new password again"
                                                                        name="password_confirmation">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <button type="submit"
                                                                class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card card-white grid-margin">
                            <div class="card-heading clearfix">
                                <h4 class="card-title">Some Info</h4>
                            </div>
                            <div class="card-body">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                    veritatis architecto.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- end page main wrapper -->
        </div>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/admin.js') }}"></script>
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
                    document.getElementById('delete-form-'+id).submit();
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
    


@endpush

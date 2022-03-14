@extends('layouts.frontend.app')

@section('title')
{{ $query }}
@endsection

    @push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
            background-color: #e0dfdf;
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
            color: #1a1919;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

        .text-white {
            color: rgb(146, 145, 145) !important;
        }

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
            background-color: rgba(24, 28, 33, 0.9) !important;
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
            -webkit-box-shadow: 0 -2px 0 #26B4FF inset;
            box-shadow: 0 -2px 0 #26B4FF inset;
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
            border-bottom-color: #fff;
        }

        .tab-pane {
            padding-top: 20px;


        }

        .form-horizontal {
            background-color: #444444;
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
    @endpush

@section('content')
    <div class="slider display-table center-text">
        <h3
         class="title display-table-cell"><b>{{ $posts->count() }} Results for {{ $query }}</b></h3>
    </div><!-- slider -->


        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-xl-6 center-block">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            @if ($post->is_approved == true)
                                {{-- @if ($post->status == true) --}}
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
                                                                <a class="name"
                                                                    href="{{ route('author.profile', $post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                                                <span>{{ $post->created_at->diffForHumans() }}</span>
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
                                                                                        : '' }}"><i
                                                                                class="ion-heart"></i>
                                                                            Like
                                                                            {{ $post->favorite_to_users->count() }}</a>

                                                                        <form id="favorite-form-{{ $post->id }}"
                                                                            method="POST"
                                                                            action="{{ route('post.favorite', $post->id) }}"
                                                                            style="display: none;">
                                                                            @csrf
                                                                        </form>
                                                                    @endguest
                                                                    <a href="#"><i class="ion-chatbubble"></i>
                                                                        Comment
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
                                                                        <p>For post a new comment. You need to login
                                                                            first.
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
                        @endforeach
                    
                </div>
                @else
                <div class="col-lg-12 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
                            <div class="blog-info">
                                <h4 class="title">
                                    <strong>Sorry, No post found :(</strong>
                                </h4>
                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endif
                
                
            </div><!-- row -->

            {{-- {{ $posts->links() }} --}}

        </div><!-- container -->
   

@endsection

@push('js')

@endpush

@extends('layouts.frontend.app')

@section('title', 'Pofile')



    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <style>
            .favorite_posts {
                color: blue;
            }

            .blog-image1 {
                width: 600px;
                height: 400px;
            }

            .main-body {
                padding: 15px;
            }

            .card {
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0, 0, 0, .125);
                border-radius: .25rem;
            }

            .card-body {
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }

            .gutters-sm {
                margin-right: -8px;
                margin-left: -8px;
            }

            .gutters-sm>.col,
            .gutters-sm>[class*=col-] {
                padding-right: 8px;
                padding-left: 8px;
            }

            .mb-3,
            .my-3 {
                margin-bottom: 1rem !important;
            }

            .bg-gray-300 {
                background-color: #e2e8f0;
            }

            .h-100 {
                height: 100% !important;
            }

            .shadow-none {
                box-shadow: none !important;
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

        </style>
    @endpush

@section('content')
    <section>
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset('storage/profile/' . $author->image) }}"
                                    class="user-profile-image rounded-circle" alt="" />
                                    <div class="mt-3">
                                        <p>{{ $author->name }}</p>
                                        <p>{{ $author->about }}</p>
                                        <strong>Author Since: {{ $author->created_at->toDateString() }}</strong><br>
                                        <strong>Total Posts : {{ $author->posts->count() }}</strong><br>
                                        <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6 center-block">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <br>
                                <div class="card">
                                    <div class="profile-timeline">
                                        <ul class="list-unstyled">
                                            <li class="timeline-item">
                                                <div class="card card-white grid-margin">
                                                    <div class="card-body">
                                                        <div class="timeline-item-header">
                                                            <a class="avatar" href="#"><img
                                                                src="{{asset('storage/profile')}}/{{ $post->user->image }}"
                                                                alt="Profile Image"></a>
                                                                <a class="name" href="{{ route('author.profile',$post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                                            <small>{{ $post->created_at->diffForHumans() }}</small>
                                                        </div>
                                                        <div class="timeline-item-post">
                                                            <div class="para">
                                                                {!! html_entity_decode($post->title) !!}
                                                            </div>
                                                            <div class="blog-image1"><img
                                                                    src="{{ asset('storage/post') }}/{{ $post->image }}"
                                                                    alt="{{ $post->title }}"></div>
                                                            <div class="para">
                                                                {!! html_entity_decode($post->body) !!}
                                                            </div>
                                                            <div class="timeline-options">
                                                                @guest
                                                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                                                                        closeButton: true,
                                                                                                        progressBar: true,
                                                                                                    })"><i
                                                                            class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                                                @else
                                                                    <a href="javascript:void(0);"
                                                                        onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0
                                                                            ? 'favorite_posts'
                                                                            : '' }}"><i class="ion-heart"></i> Like
                                                                        {{ $post->favorite_to_users->count() }}</a>

                                                                    <form id="favorite-form-{{ $post->id }}" method="POST"
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
                                                                            <img
                                                                                src="{{ asset('storage/profile') }}/{{ $comment->user->image }}"
                                                                                alt="Profile Image">
                                                                            <h4 class="text h6 mt-2">
                                                                                {{ $comment->user->name }}</h4>
                                                                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                                           
                                                                        </div>
                                                                        <p class="timeline-comment-text">{{ $comment->comment }}</p>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="comment-form">
                                                                @guest
                                                                    <p>For post a new comment. You need to login first. <a
                                                                            href="{{ route('login') }}">Login</a></p>
                                                                @else
                                                                    <form method="post"
                                                                        action="{{ route('comment.store', $post->id) }}">
                                                                        @csrf
                                                                        <div class="post-options">
                                                                            <div class="col-sm-12">
                                                                                <input name="comment"
                                                                                    class="text-area-messge form-control"
                                                                                    placeholder="Enter your comment"
                                                                                    aria-required="true" aria-invalid="false">
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <div class="col-md-10 col-sm-12">
                                    <div class="card h-100">
                                        <div class="single-post post-style-1">

                                            <div class="blog-image"><img
                                                    src="{{ asset('storage/post') }}/{{ $post->image }}"
                                                    alt="{{ $post->title }}"></div>

                                            <a class="avatar"
                                                href="{{ route('author.profile', $post->user->username) }}"><img
                                                    src="{{ asset('storage/profile') }}/{{ $post->user->image }}"
                                                    alt="Profile Image"></a>

                                            <div class="blog-info">

                                                <h4 class="title"><a
                                                        href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a>
                                                </h4>

                                                <ul class="post-footer">
                                                    <li>
                                                        @guest
                                                        <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
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
                                                                class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

                                                        <form id="favorite-form-{{ $post->id }}" method="POST"
                                                            action="{{ route('post.favorite', $post->id) }}"
                                                            style="display: none;">
                                                            @csrf
                                                        </form>
                                                        @endguest

                                                    </li>
                                                    <li><a href="#"><i
                                                                class="ion-chatbubble"></i>{{ $post->comments->count() }}</a>
                                                    </li>
                                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                                </ul>

                                            </div><!-- blog-info -->
                                        </div><!-- single-post -->
                                    </div><!-- card -->
                                </div><!-- col-lg-4 col-md-6 -->
                            @endforeach
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



                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p>{{ $author->name }}</p><br>
                            <p>{{ $author->about }}</p><br>
                            <strong>Author Since: {{ $author->created_at->toDateString() }}</strong><br>
                            <strong>Total Posts : {{ $author->posts->count() }}</strong>
                        </div>

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section --> --}}

@endsection

@push('js')

@endpush

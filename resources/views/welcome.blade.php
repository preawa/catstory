@extends('layouts.frontend.app')

@section('title', 'Home')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">
    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" >


    <style>

        #sum_box h4 {
            text-align: left;
            margin-top: 0px;
            font-size: 30px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }


        #sum_box .db:hover {
            background: #40516f;
            color: #fff;
        }




        #sum_box .db:hover .icon {
            opacity: 1;
            color: #999999;
        }

        #sum_box .icon {
            color: #fff;
            font-size: 55px;
            margin-top: 7px;
            margin-bottom: 0px;
            float: right;
        }


        .panel.income.db.mbm{
                background-color: #ce6159;
        }

        .panel.profit.db.mbm{
                background-color: #ce6159;
        }


        .panel.task.db.mbm{
                background-color: #ce6159;
        }
        img.1 {
            height: 150px;
            width: 100%;
        }

        div [class^="col-"] {
            padding-left: 5px;
            padding-right: 5px;
        }

        .card {
            height: auto;
            width: 100%;
            background: rgb(184, 183, 183);
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
            color: #d6502f
        }

        .card-title i:hover {
            transform: scale(1.25) rotate(100deg);
            color: #18d4ca;

        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
        }

        .card-text {
            height: 80px;
        }

        .card::before,
        .card::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: scale3d(0, 0, 1);
            transition: transform .3s ease-out 0s;
            background: rgba(255, 255, 255, 0.1);
            content: '';
            pointer-events: none;
        }

        .card::before {
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
        }


        .card.card-white {
            background-color: #ffffff;
            border: 1px solid transparent;
            border-radius: 4px;
            box-shadow: 0 0.05rem 0.01rem rgba(75, 75, 90, 0.075);
            padding: 10px;
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


    </style>
@endpush

@section('content')
    <div class="container mt-2">
        <div class="row">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    @if ($post->is_approved == true)
                        <div class="col-md-3 col-sm-6">
                            <br>
                            <div class="card card-block">
                                <img src="{{ asset('storage/post') }}/{{ $post->image }}" alt="{{ $post->title }}">
                                <h5 class="card-title mt-3 mb-3"><i class="ionicons ion-person"></i> &nbsp{{ $post->user->name }}
                                </h5>
                                <div class="para">
                                    {!! html_entity_decode($post->title) !!}
                                </div>
                                <br>
                                <span class="options">
                                    {{-- <div class="timeline-options"> --}}
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
                                                    class="ion-heart"></i> ถูกใจ
                                                {{ $post->favorite_to_users->count() }}</a>
                                            <form id="favorite-form-{{ $post->id }}" method="POST"
                                                action="{{ route('post.favorite', $post->id) }}" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                        <a href="#"><i class="ion-chatbubble"></i> แสดงความคิดเห็น
                                            {{ $post->comments->count() }}</a>
                                        {{-- <a href="#"><i class="ion-eye"></i>View
                                            {{ $post->view_count }}</a> --}}
                                    {{-- </div> --}}
                                </span>
                                _________________________
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
                                        <p>กรุณาเข้าสู่ระบบเพื่อแสดงความคิดเห็น <a
                                                href="{{ route('login') }}">เข้าสู่ระบบ</a></p>
                                    @else
                                        <form method="post" action="{{ route('comment.store', $post->id) }}">
                                            @csrf
                                            <div class="post-options">
                                                <div class="col-sm-12">
                                                    <input name="comment" class="text-area-messge form-control"
                                                        placeholder="แสดงความคิดเห็น" aria-required="true"
                                                        aria-invalid="false">
                                                    <br>
                                                    <button class="btn btn-first active float-right">แสดงความคิดเห็น</button>
                                                </div><!-- col-sm-12 -->
                                            </div>
                                        </form>
                                    @endguest
                                </div><!-- comment-form -->
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

    </div>


@endsection


@push('js')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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



@endpush

@extends('layouts.frontend.app')

@section('title', 'Chats')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">

        <!-- fonts.google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">

    @endpush

    <style>
        body{
            background-color: #fff !important;
        }
        footer .icons > li > a{
            padding: 12px;
        }
    </style>
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                        @foreach ($users as $user)
                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count
                                notification--}}
                                @if ($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        <a class="avatar" href="#"><img
                                                src="{{ asset('storage/profile') }}/{{ $user->image }}"
                                                alt="Profile Image"></a>
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection

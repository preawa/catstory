@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
        <!-- Bootstrap Select Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
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
                background-color: #dddddd;
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

            .text-white {
                color: rgb(0, 0, 0) !important;
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
                border-bottom-color: rgb(197, 197, 197);
            }

            .tab-pane {
                padding-top: 20px;
                background-color: #ffffff;
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
    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
            data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
            data-swiper-breakpoints="true" data-swiper-loop="true">
            <div class="swiper-wrapper">

                @forelse($categories as $category)
                    <div class="swiper-slide">
                        <a class="slider-category" href="{{ route('category.posts', $category->slug) }}">
                            <div class="blog-image"><img src="{{ asset('storage/category/slider') }}/{{ $category->image }}"
                                    alt="{{ $category->name }}"></div>

                            <div class="category">
                                <div class="display-table center-text">
                                    <div class="display-table-cell">
                                        <h3><b>{{ $category->name }}</b></h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div><!-- swiper-slide -->
                @empty
                    <div class="swiper-slide">
                        <strong>No Data Found :(</strong>
                    </div><!-- swiper-slide -->
                @endforelse

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->
    <br />
    <div class="bg-white">
        <div class="page-inner no-page-title">
            <!-- start page main wrapper -->
            <div id="main-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-xl-6 center-block">
                            @if ($posts->count() > 0)
                                @foreach ($posts as $post)
                                    @foreach ($catowners as $catowner)
                                        <div class="card">
                                            <div class="profile-timeline center-block">
                                                <ul class="list-unstyled">
                                                    <li class="timeline-item">
                                                        <div class="card card-white grid-margin">
                                                            <div class="card-body">
                                                                <div class="timeline-item-header">
                                                                    <a class="avatar" href="#"><img
                                                                            src="{{ asset('storage/profile') }}/{{ $catowner->user->image }}"
                                                                            alt="Profile Image"></a>

                                                                    <a class="name"
                                                                        href="{{ route('author.profile', $catowner->user->username) }}"><b>{{ $catowner->user->name }}</b></a>
                                                                    <span>{{ $catowner->created_at->diffForHumans() }}</span>


                                                                </div>

                                                                <div class="para">
                                                                    ชื่อแมว : {!! html_entity_decode($catowner->name) !!}<br>
                                                                    ชื่อผู้เขียน : {!! html_entity_decode($catowner->user->name) !!}
                                                                </div>
                                                                <a
                                                                    href="{{ route('author.catowner.show', $catowner->id) }}">
                                                                    <b>{{ $catowner->address_address }}</b></a>

                                                                    
                                                                        <div class="blog-image"><img src="{{ asset('storage/catowner') }}/{{ $catowner->image }}"
                                                                                alt="{{ $catowner->name }}"></div>
                                            
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

                                                                        <form id="favorite-form-{{ $post->id }}" method="POST"
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
                                                                        <p>For post a new comment. You need to
                                                                            login
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
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        {{ $catowners->links() }}
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
    <script>
        var lat = '{{ $catowner->latitude }}';
        var long = '{{ $catowner->longitude }}';

        var zoom = 8;

        var fromProjection = new OpenLayers.Projection("EPSG:4326"); // Transform from WGS 1984
        var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
        var position = new OpenLayers.LonLat(long, lat).transform(fromProjection, toProjection);

        map = new OpenLayers.Map("Map");
        var mapnik = new OpenLayers.Layer.OSM();
        map.addLayer(mapnik);

        var markers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(markers);
        markers.addMarker(new OpenLayers.Marker(position));

        map.setCenter(position, zoom);

    </script>


@endpush

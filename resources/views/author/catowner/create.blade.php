@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css"
            type="text/css">
            
    @endpush

@section('content')
    <form action="{{ route('author.catowner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h5 class="card-title text-white"> Cats Owner</h5>
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> ชื่อแมว </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="ชื่อ">
                            </div>
                            <div class="form-line">
                                <label for="autocomplete"> ลักษณะแมว </label>
                                <textarea type="text" id="body" class="form-control" name="body" placeholder="ลักษณะแมว"
                                    aria-required="true" aria-invalid="false"></textarea>

                            </div>
                            <br>
                            {{-- <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input type="file" name="image">
                            </div> --}}

                            <div class="form-group">
                                <label for="location"> Location/City/Address </label>
                                <button type="button" class="btn btn-success waves-effect" onclick="getLocation()">
                                    location now
                                </button>

                                <a class="btn btn-primary waves-effect" href="{{ route('author.catowner.location') }}">
                                    location value
                                </a>
                            </div>

                            <div class="form-group" id="lat_area">
                                <label> Latitude Longitude </label>
                                <input type="text" name="latitude" id="lat" class="form-control" readonly required>
                                <input type="text" name="longitude" id="long" class="form-control" readonly required>
                            </div>
                            
                            <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input type="file" name="image">
                            </div>


                            <div class="form-group">
                                <input type="checkbox" id="owner" class="filled-in" name="status" value="1">
                                <label for="owner">มีเจ้าของ</label>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="noowner" class="filled-in" name="status1" value="2">
                                <label for="noowner">ไม่มีเจ้าของ</label>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect" id="form">BACK</a>
                            <button type="submit" class="btn btn-success"> Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    {{-- javascript code --}}
    {{-- <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initAutocomplete"
        type="text/javascript"></script> --}}
    <script>
        $(document).ready(function() {
            // $("#lat_area").addClass("d-none");
            // $("#lat_area1").addClass("d-none");
        });

        // var x = document.getElementById("lat_long");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            // x.innerHTML = " " + position.coords.latitude +
            //     " " + position.coords.longitude;
            $("input#lat").val(position.coords.latitude);
            $("input#long").val(position.coords.longitude);
           
        }

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        var lat = getUrlParameter('latitude');
        var long = getUrlParameter('longitude');
        // var location = GetURLParameter('location');
        // debugger;
        $("input#lat").val(lat);
        $("input#long").val(long);
        // console.log(lat_lng);

    </script>

@endpush

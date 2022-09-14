@extends('layouts.frontend.app')

@section('title', 'ShowCat')

@push('css')
    <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">
    <style type="text/css">
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */

        html,
        /* body {
                                    height: 100%;
                                    margin: 0;
                                    padding: 0;
                                }
                                @media (min-width: 1000px) {
                                    footer {
                                    position: fixed;
                                    right: 0;
                                    bottom: 0;
                                    left: 0;
                                    z-index: 800;
                                }
                                } */

    </style>
@endpush

@section('content')

    <body>
        <div class="container">
            <br /><br />
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="mb-3">
                        <img src="{{ asset('storage/cat') }}/{{ $cats[0]['image'] }}" class="w-100">
                    </div>
                    <div class="d-flex mb-3">
                        <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect mr-1"
                            id="form">BACK</a>

                        <form action="{{ route('author.catowner.booking', $cats[0]) }}">
                            <button type="submit" class="btn btn-first">booking</button>
                            {{-- <input type="button" class="btn btn-first active float-right" value="booking"/> --}}
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <div class="card card-selectcat mb-3">
                        <div class="row center-block">
                            <div class="col-xs-10 col-sm-10 col-md-10 ">
                                <table>
                                    <tr>

                                        <td><strong>ชื่อแมว :</strong></td>
                                        <td>
                                            <h5 class="h5">{{ $cats[0]['name'] }}</h5>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td><strong>ลักษณะแมว :</strong></td>
                                        <td>{{ $cats[0]['body'] }}</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            @if ($cats[0]['status'])
                                                <strong>มีเจ้าของ</strong>
                                            @else
                                                <strong>ไม่มีเจ้าของ</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @if (session('success'))
                            <h1>{{ session('success') }}</h1>
                        @endif
                        <form method="POST" action="{{ route('author.catowner.delcat', $cats[0]['id']) }}">
                            @csrf
                            <div class="col-12 col-sm-8">
                                <div class="card card-selectcat mb-3">
                                    <div class="row center-block">
                                        <div class="col-xs-10 col-sm-10 col-md-10 ">
                                            <select class="form-control" id="selcat" name="selcat" required focus>
                                                <option value="" disabled selected>--โปรดเลือกแมวซ้ำ--</option>
                                                @foreach ($allcats as $allcat)
                                                    <option value="{{ $allcat->id }}">{{ $allcat->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <div>
                                                <button type="submit" class="btn btn-first"
                                                    onclick="deleteCatowner({{ $allcat->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $allcat->id }}"
                                                    action="{{ route('author.catowner.destroy', $allcat->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                        <label class="col-sm-8 col-form-label" id="displayOwner"></label>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="map" style="width:100%; height:300px"></div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </body>

@endsection

@push('js')
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places" async
        defer></script>
    <script>
        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        let labelIndex = 0;

        function initMap() {
            const myLatLng = {
                lat: {{ $cats[0]['latitude'] }},
                lng: {{ $cats[0]['longitude'] }}
            };

            const bangalore = {
                lat: 18.898309197261717,
                lng: 99.00446459999999
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: bangalore,
            });
            // This event listener calls addMarker() when the map is clicked.
            // google.maps.event.addListener(map, "click", (event) => {
            //     addMarker(event.latLng, map);
            new google.maps.Marker({
                position: myLatLng,
                map,
                label: "{{ $cats[0]['name'] }}",
            });
            // });

        }

        // Adds a marker to the map.
        function addMarker(location, map) {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.

            valuelocate = "latitude=" + location.lat() + "&longitude=" + location.lng();

            // window.location = "{{ route('author.catowner.create') }}?f=0&" + valuelocate;
            new google.maps.Marker({
                position: location,
                label: labels[labelIndex++ % labels.length],
                map: map,
            });
        }
        $(document).ready(function() {
            initMap();
        });
    </script>
@endpush

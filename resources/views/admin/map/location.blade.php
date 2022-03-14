@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <style type="text/css">
            #map {
                height: 100%;
            }

            /* Optional: Makes the sample page fill the window. */

            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

        </style>
    @endpush

@section('content')

    <body>

        <div id="map"></div>

    </body>
@endsection

@push('js')
    
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places"
        type="text/javascript"></script>
   
    <script>
        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        let labelIndex = 0;

        function initMap() {
            const bangalore = {
                lat: 18.898309197261717, 
                lng: 99.00446459999999
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: bangalore,
            });
            // This event listener calls addMarker() when the map is clicked.
            google.maps.event.addListener(map, "click", (event) => {
                addMarker(event.latLng, map);
                
            });
           
        }

        // Adds a marker to the map.
        function addMarker(location, map) {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.

            valuelocate = "latitude=" + location.lat() + "&longitude=" + location.lng();

            window.location = "{{ route('admin.map.create') }}?f=0&" + valuelocate;
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

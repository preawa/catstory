@extends('layouts.backend.app')

@section('title', 'Map')

    @push('css')

    @endpush

@section('content')
<body>
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.map.index') }}" class="btn btn-danger waves-effect" id="form">BACK</a>
        <br /><br />
        <div class="row center-block">
            <div class="col-xs-10 col-sm-10 col-md-10 ">
                <table>
                    <tr>
                        <td><strong>ชื่อแมว :</strong></td>
                        <td>{{ $cats[0]['name'] }}</td>
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
                <div class="body">
                    <img src="../../storage/cat/{{ $cats[0]['image'] }}" width="40%" height="40%" alt="">
                </div>
            </div>
        </div>
       
        <br /><br />
        <div id="map" style="width:1100px; height:600px"></div>

    </div>
</body>

@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initMap"
        async defer></script>
    <script>
        const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        let labelIndex = 0;

        function initMap() {
            const myLatLng = {
                lat: {{$cats[0]['latitude']}},
                lng: {{$cats[0]['longitude']}}
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
                label: "Hello World!",
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

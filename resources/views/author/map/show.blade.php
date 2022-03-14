@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="container-fluid">
            <br /><br />
            <!-- Vertical Layout | With Floating Label -->
            <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect" id="form">BACK</a>
            <br /><br />
            <table>
                <tr>
                    <td><strong>ชื่อแมว :</strong></td>
                    <td>{{ $map->title }}</td>
                </tr>
               

            </table>

            </div>
            <div id="Map" style="width:1100px; height:600px"></div>
    </div>
@endsection

@push('js')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initialize"
        async defer></script>
    <script>
        var lat = '{{ $map->latitude }}';
        var long = '{{ $map->longitude }}';
        var zoom = 10;

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

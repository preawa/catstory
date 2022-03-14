@extends('layouts.backend.app')

@section('title', 'Post')

    @push('css')
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    <style>
        .center-block {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
    </style>

    @endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.catowner.index') }}" class="btn btn-danger waves-effect">BACK</a>
        @if ($catowner->is_approved == false)
            <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $catowner->id }})">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
            <br>
            <form method="post" action="{{ route('admin.catowner.approve', $catowner->id) }}" id="approval-form"
                style="display: none">
                @csrf
                @method('PUT')
            </form>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <br /><br />
        <div class="row center-block">
            <div class="col-xs-10 col-sm-10 col-md-10 ">
                <table>
                    <tr>
                        <td><strong>ชื่อแมว :</strong></td>
                        <td>{{ $catowner->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>ชื่อเจ้าของ :</strong></td>
                        <td>{{ $catowner->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>ลักษณะแมว :</strong></td>
                        <td>{{ $catowner->body }}</td>
                    </tr>
                    <tr>
                        <td><strong>ที่อยู่ :</strong></td>
                        <td>{{ $catowner->address_address }}</td>

                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if ($catowner->status)
                                <strong>มีเจ้าของ</strong>
                            @else
                                <strong>ไม่มีเจ้าของ</strong>
                            @endif
                        </td>
                    </tr>

                </table>
                <div class="body" >
                    <img class="img-responsive thumbnail" style="width:500px; height:400px" src="{{ asset('storage/catowner') }}/{{ $catowner->image }}" alt="">
                </div>
            </div>
        </div>

        <div id="Map" style="width:700px; height:500px"></div>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>

        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }

    </script>
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initialize"
        async defer></script>
    <script>
        var lat = '{{ $catowner->latitude }}';
        var long = '{{ $catowner->longitude }}';
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

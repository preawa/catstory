@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <style type="text/css">
            html,
            body,
            #mapdiv {
                width: 100%;
                height: 100%;
                margin: 0;
            }

            .olImageLoadError {
                display: none;
            }

            /* no pink tiles */

        </style>
    @endpush

@section('content')

    <body>

        <div id="mapdiv"></div>

    </body>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
    <script type="text/javascript">
        //Set up a click handler
        OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {
            defaultHandlerOptions: {
                'single': true,
                'double': false,
                'pixelTolerance': 0,
                'stopSingle': false,
                'stopDouble': false
            },

            initialize: function(options) {
                this.handlerOptions = OpenLayers.Util.extend({}, this.defaultHandlerOptions);
                OpenLayers.Control.prototype.initialize.apply(
                    this, arguments
                );
                this.handler = new OpenLayers.Handler.Click(
                    this, {
                        'click': this.clickMap
                    }, this.handlerOptions
                );
            },

            clickMap: function(e) {
                //A click happened!
                var lonlat = map.getLonLatFromViewPortPx(e.xy)

                lonlat.transform(
                    new OpenLayers.Projection("EPSG:900913"),
                    new OpenLayers.Projection("EPSG:4326")
                );
                var valuelocate;
                valuelocate = "latitude=" + lonlat.lat + "&longitude=" + lonlat.lon ;
                
                // alert("{{ route('author.catowner.create') }}?location=" + valuelocate);

                window.location = "{{ route('author.catowner.create') }}?f=0&" + valuelocate;
            }



        });

        var map;

        function init() {
            map = new OpenLayers.Map('mapdiv');

            map.addLayer(new OpenLayers.Layer.OSM());
            map.zoomToMaxExtent();

            var click = new OpenLayers.Control.Click();
            map.addControl(click);
            click.activate();

        }
        $(document).ready(function() {
            init();
        });

    </script>
@endpush

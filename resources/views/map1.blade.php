@extends('layouts.frontend.app')
@section('title', 'Map')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/auth/custom.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;300;400&display=swap" rel="stylesheet">


    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/frontend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .tabs-alt.nav-tabs .nav-link.active,
        .tabs-alt.nav-tabs .nav-link.active:hover,
        .tabs-alt.nav-tabs .nav-link.active:focus,
        .tabs-alt>.nav-tabs .nav-link.active,
        .tabs-alt>.nav-tabs .nav-link.active:hover,
        .tabs-alt>.nav-tabs .nav-link.active:focus {
            -webkit-box-shadow: 0 -2px 0 #d3c0ac inset;
            box-shadow: 0 -2px 0 #d3c0ac inset;
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
            /* background-color: #ffffff; */
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

        /* The popup bubble styling. */
        .popup-bubble {
            /* Position the bubble centred-above its parent. */
            position: absolute;
            top: 0;
            left: 0;
            transform: translate(-50%, -100%);
            /* Style the bubble. */
            background-color: white;
            padding: 5px;
            border-radius: 5px;
            font-family: sans-serif;
            overflow-y: auto;
            max-height: 60px;
            box-shadow: 0px 2px 10px 1px rgba(0, 0, 0, 0.5);
        }

        /* The parent of the bubble. A zero-height div at the top of the tip. */
        .popup-bubble-anchor {
            /* Position the div a fixed distance above the tip. */
            position: absolute;
            width: 100%;
            bottom: 8px;
            left: 0;
        }

        /* This element draws the tip. */
        .popup-bubble-anchor::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            /* Center the tip horizontally. */
            transform: translate(-50%, 0);
            /* The tip is a https://css-tricks.com/snippets/css/css-triangle/ */
            width: 0;
            height: 0;
            /* The tip is 8px high, and 12px wide. */
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 8px solid white;
        }

        /* JavaScript will position this div at the bottom of the popup tip. */
        .popup-container {
            cursor: auto;
            height: 0;
            position: absolute;
            /* The max width of the info window. */
            width: 200px;
        }

        section.content {
            margin: 0 !important;
        }

    </style>
@endpush

@section('content')
    <br /><br />

    <body>
        <div class="container">
            <!-- Exportable Table -->
            <hr class="m-0">
            <div class="widget widget-tabbed ">
                <!-- Nav tab -->
                <ul
                    class="nav nav-tabs tabs-alt justify-content-center text-white tab-profile bg-color2 text-center d-block d-sm-flex">
                    <li class="nav-item">
                        <a class="nav-link py-4 " href="{{ route('map') }}">แมวทั้งหมด</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link py-4 active" href="{{ route('map1') }}" >แมวมีเจ้าของ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link py-4" href="{{ route('map2') }}" >แมวไม่มีเจ้าของ</a>
                    </li>
                </ul>
                <!-- End nav tab -->

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Tab Posts -->
                    <div class="tab-pane animated active fadeInRight" id="my-post">
                        <div class="user-profile-content">
                            <br>
                            <div class="col-lg-12 col-xl-11 center-block">
                                <div class="card grid-margin">
                                    <div class="card1-body">
                                        <div id="map" style="width:100%; height:500px"></div>
                                        <br>
                                        <div class="header">
                                            <h5 class="h5">
                                                แมวทั้งหมดในแผนที่
                                            </h5>
                                        </div>
                                        <div class="body">
                                            <div class="table-responsive" id="showmap-cat">
                                                <table
                                                    class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับที่</th>
                                                            <th>ลำดับแมว</th>
                                                            <th>ชื่อแมว</th>
                                                            <th>ผู้ลงทะเบียน</th>
                                                            <th>ลักษณะแมว</th>
                                                            <th>สถานะ</th>
                                                            <th>รายละเอียด</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cats as $key => $cat)
                                                            @if ($cat->status != 0)
                                                                <tr>
                                                                    <td>{{ $i++ + $key}}</td>                                                          
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ str_limit($cat->name, '10') }}</td>
                                                                    <td>{{ $cat->user->name }}</td>
                                                                    <td>{{ $cat->body }}</td>
                                                                    <td>
                                                                        @if ($cat->status == true)
                                                                            <strong>มีเจ้าของ</strong>
                                                                        @else
                                                                            <strong>ไม่มีเจ้าของ</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('author.catowner.show', $cat->id) }}"
                                                                            class="btn btn-first waves-effect">
                                                                            รายละเอียด
                                                                        </a>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                {{ $cats->links() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End div .user-profile-content -->
                    </div><!-- End div .tab-pane -->
                    <!-- End Tab timeline -->
                   

                   
                </div>
                <!-- #END# Exportable Table -->
            </div>
            <!-- #END# Exportable Table -->
            {{-- <div id="map" style="width:100%; height:500px"></div> --}}
            <br /><br />

        </div>
    </body>
@endsection


@push('js')

    {{-- javascript code --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initMap"
        async defer>
    </script>

        <script>
            var arrMarkers = [];
           function initMap(pv_values = 0) {
               // map options
               const bangalore = {
               lat: 18.898309197261717,
               lng: 99.00446459999999
           };
               var options = {
                   zoom: 15,
                   streetViewControl: false,
                   center: bangalore
   
               }
   
   
               // new maps
               var map = new google.maps.Map(document.getElementById('map'), options);
            //    var map1 = new google.maps.Map(document.getElementById('map1'), options);
            //    var map2 = new google.maps.Map(document.getElementById('map2'), options);
               

           @foreach($cats as $cat)
           @if ($cat->status != 0)
               // <?php  //foreach ($arr_cmap as $key):
                   if(empty($cat['latitude']) || empty($cat['longitude'])){
                       continue;
                   }
   
             ?>

               var latlng = {
                   lat: <?php echo $cat['latitude'] ?>,
                   lng: <?php echo $cat['longitude'] ?>
               }
   
               var contentString =
                   '<div id="content">' +
                   '<div id="siteNotice">' +
                   "</div>" +
                   '<h3 id="firstHeading" class="firstHeading text-center"><?php echo $cat['name'] ?></h3>' +
                   '<div id="bodyContent">' +
                   "<div style='float:right;'>" +
                   "<p style='padding-left:1rem;'><?php echo $cat['body']; ?></p>" +
                   "<div class='text-right'><p style='padding-left:1rem;'><a target='_blank' class='btn btn-primary btn-sm' href='{{ route('author.catowner.show',$cat->id) }}'>รายละเอียด</a></div></p>" +
                   "</div>" +
                   "<div style='float:left'>" +
                   "<img style='width:100px;' src='storage/cat/{{ $cat->image }}'>" +
                   "</div>" +
                   "</div>" +
                   "</div>";
   
               arrMarkers.push({
                   coords: latlng,
                   content: contentString,
   
               });
   
               // <?php //endforeach ?>
                @endif
                @endforeach

               // Loop through markers
               for (var i = 0; i < arrMarkers.length; i++) {
                   // if (pv_values && pv_values != arrMarkers[i]['pv_id']) {
                   //     continue;
                   // }
                   addMarker(arrMarkers[i]);
               }
               // add marker function
   
               function addMarker(props) {
   
                   var marker = new google.maps.Marker({
                       position: props.coords,
                       map: map,
                       icon: props.iconImage
                   });
   
   
                   // check for custom icon
                   if (props.iconImage) {
                       // set icon
                       marker.setIcon(props.iconImage);
                   }
   
                   // check content
                   if (props.content) {
                       // set content
                       var infoWindow = new google.maps.InfoWindow({
                           content: props.content
                       });
   
   
                   }
                   google.maps.event.addListener(marker, 'click', function() {
   
                       if (!marker.open) {
                           infoWindow.open(map, marker);
                           //map.setZoom(8);
                           marker.open = true;
                       } else {
                           infoWindow.close();
                           marker.open = false;
                           //map.setZoom(5);
                           //map.setCenter(thailand);
                       }
                       google.maps.event.addListener(map, 'click', function() {
                           infoWindow.close();
                           //map.setZoom(5);
                           //map.setCenter(thailand);
   
   
                       });
   
                       google.maps.event.addListener(infoWindow, 'closeclick', function() {
                          // map.setZoom(5);
                          // map.setCenter(thailand);
   
                       });
                   });
   
   
               }
            }
           
       </script>    
@endpush

@extends('layouts.backend.app')

@section('title', 'Map')

    @push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
            rel="stylesheet">

    @endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.map.create') }}">
                <i class="material-icons">add</i>
                <span>Add New Map</span>
            </a>
        </div>
        <div id="map" style="width:1100px; height:600px"></div>
        <br/><br/>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL MAPS
                            {{-- <span class="badge bg-blue">{{ $form->count() }}</span> --}}
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อแมว</th>
                                        <th>ผู้ลงทะเบียน</th>
                                        <th>ลักษณะแมว</th>
                                        <th>สถานะ</th>
                                        <th>อนุญาต</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $key => $cat)
                                        <tr>
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
                                                @if($cat->is_approved == true)
                                                    <span class="badge bg-blue">Approved</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($cat->is_approved == false)
                                                <button type="button" class="btn btn-success waves-effect"
                                                    onclick="approveMap({{ $cat->id }})">
                                                    <i class="material-icons">done</i>
                                                </button>
                                                <form method="post"
                                                    action="{{ route('admin.map.approve', $cat->id) }}"
                                                    id="approval-form-{{ $cat->id }}" style="display: none">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @endif
                                                <a href="{{ route('admin.map.show', $cat->id) }}"
                                                class="btn btn-success waves-effect">
                                                รายละเอียด
                                            </a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.3.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteMap(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
        function approveMap(id) {
            debugger;
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
                    document.getElementById('approval-form-'+ id).submit();
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
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initMap" async
        defer></script>
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
               
    
            @foreach($cats as $cat)
            @if ($cat->is_approved == true)
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
                    "<div class='text-right'><p style='padding-left:1rem;'><a target='_blank' class='btn btn-primary btn-sm' href='{{ route('admin.map.show',$cat->id) }}'>รายละเอียด</a></div></p>" +
                    "</div>" +
                    "<div style='float:left'>" +
                    "<img style='width:100px;' src='{{asset('storage/cat')}}/{{ $cat->image }}'>" +
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

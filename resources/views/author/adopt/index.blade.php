@extends('layouts.backend.style')

@section('title', 'Map')

    @push('css')
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
            rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    @endpush

@section('content')
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
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($catowners as $key => $catowner)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($catowner->name, '10') }}</td>
                                        <td>{{ $catowner->user->name }}</td>
                                        <td>{{ $catowner->body}}</td>
                                        <td>{{ $catowner->address_address }}</td>
                                        
                                        <td>
                                            @if ($catowner->status == true)
                                            <strong>มีเจ้าของ</strong>
                                        @else
                                            <strong>ไม่มีเจ้าของ</strong>
                                        @endif
                                        </td>
                                        <td>{{ $catowner->created_at }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('author.catowner.show',$catowner->id) }}" class="btn btn-success waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <button class="btn btn-danger waves-effect" type="button"
                                                onclick="deleteCatowner({{ $catowner->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $catowner->id }}"
                                                action="{{ route('author.catowner.destroy', $catowner->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    {{-- javascript code --}}
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initAutocomplete"
        type="text/javascript"></script>
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

@endpush

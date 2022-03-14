@extends('layouts.backend.app')

@section('title', 'Post')

    @push('css')
        <!-- Bootstrap Select Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    @endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('author.catowner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                   ADD NEW POST
                                </h2>
                            </div>
                            <div class="body">
                                <div class="form-line">
                                    <label for="name"> ชื่อแมว </label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ชื่อ">
                                </div>
                                <br>
                                <div class="form-line">
                                    <label for="autocomplete"> ลักษณะแมว </label>
                                    <textarea type="text" id="body" class="form-control" name="body" placeholder="ลักษณะแมว"
                                        aria-required="true" aria-invalid="false"></textarea>

                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image">
                                </div>

                                <div class="form-line">
                                    <label for="autocomplete"> Location/City/Address </label>
                                    <input type="text" name="address_address" id="address_address" class="form-control"
                                        placeholder="Select Location">
                                </div>

                                <div class="form-line" id="lat_area">
                                    <label for="latitude"> Latitude </label>
                                    <input type="text" name="latitude" id="latitude" class="form-control">
                                </div>

                                <div class="form-line" id="long_area">
                                    <label for="latitude"> Longitude </label>
                                    <input type="text" name="longitude" id="longitude" class="form-control">
                                </div>
                                <br>

                                <div class="form-group">
                                    <input type="checkbox" id="owner" class="filled-in" name="status" value="1">
                                    <label for="owner">มีเจ้าของ</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="noowner" class="filled-in" name="status1" value="2">
                                    <label for="noowner">ไม่มีเจ้าของ</label>
                                </div>
                            </div>

                            <div class="footer">
                                <a href="{{ route('admin.catowner.index') }}" class="btn btn-danger waves-effect"
                                    id="form">BACK</a>
                                <button type="submit" class="btn btn-success"> Submit </button>
                            </div>
                            <br/><br/>
                        </div>
                    </div>
                
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function() {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('
            assets / backend / plugins / tinymce ') }}';
        });

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

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
            <div class="container-fluid">
                <br /><br />
        
                <!-- Vertical Layout | With Floating Label -->
                <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect" id="form">BACK</a>
                
                    
                <div class="form-group">
                                <label for="name"> ชื่อแมว </label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="ชื่อ">
                </div>
            </div>
        </body>
    
@endsection

@push('js')

@endpush

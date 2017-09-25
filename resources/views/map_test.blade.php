@extends('layouts.app')

@section('css')
<link
rel="stylesheet"
href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
integrity=""/>
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">MAP TEST</div>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-4">
                            <input
                            id="lat"
                            class="form-control"
                            type="number"
                            value="43.604652"
                            step='0.001'
                            >
                        </div>
                        <div class="col-xs-4">
                            <input
                            id="long"
                            class="form-control"
                            type="number"
                            value="1.444209"
                            step='0.001'
                            >
                        </div>
                        <div class="col-xs-4">
                        <input
                        id="zoom"
                        class="form-control"
                        type="range"
                        value="12"
                        step="0.5"
                        min="3"
                        max="15"
                        >
                        </div>
                        <div class="col-xs-4">
                        <input
                        id="city"
                        type="text"
                        >
                        </div>
                    </div>

                    {{-- <indivput hidden id="lat" type="number" value='{{ $pressetmap->lat }}'> --}}
                    {{-- <input hidden id="long" type="number" value='{{ $pressetmap->long }}'> --}}
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- AIzaSyBKLjD9bJcoONod2u0eFTbiDIpJdS5VDaY --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiDPowZRVCL-6V4jy5s2LnyQB-KjXiqOQ&libraries=places&callback=initAutocomplete" async defer></script>

<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

<script src="{{ asset('js/map.js') }}"></script>
@endsection
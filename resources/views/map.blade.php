@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity=""/>

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@endsection

@section('content')

<div class="container">
    <div class="pagecontainer row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">MAP TEST</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <input
                            id="city"
                            class="form-control"
                            type="text"
                            >
                        </div>
                    </div>
                    <div style="display : none;" >
                        @foreach($places as $keyplace => $place)
                        <div class="place" id="{{ $keyplace }}">
                            <input readonly 
                            class="lat"
                            value="{{ $place->lat }}"
                            >
                            <input readonly
                            class="long"
                            value="{{ $place->long }}"
                            >
                            {{-- <input readonly
                            class="radius"
                            value="{{ $place->rad }}"
                            > --}}
                        </div>
                        @endforeach
                    </div>
                    <input
                    id="lat"
                    class="form-control"
                    type="number"
                    value="43.604652"
                    step=".001"
                    style="display : none;" 
                    >
                    <input
                    id="long"
                    class="form-control"
                    type="number"
                    value="1.444209"
                    step='0.001'
                    style="display : none;"
                    >
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
{{-- AIzaSyCbDnwlE6W0EO0LIIp16f4yqgzye78ENRY --}}
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV-FwOAdr1WGuFP1vhXI9fT4QMUvYiZnI&libraries=places&callback=initAutocomplete" async defer></script>

<script src="{{ asset('js/map.js') }}"></script>

@endsection
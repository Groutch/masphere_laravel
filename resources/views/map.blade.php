@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css" integrity=""/>


<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@endsection

@section('content')

<div class="container">
    <div class="pagecontainer row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Carte des évènements</div>
                <div class="card">
                        <div id="mapid"></div>
						<div class="card-block">
                        <input readonly hidden
								class="slug"
								value="{{Auth::User()->roles->implode('slug')}}"
                                >
							@foreach( $places as $key => $place)
							{{-- var_dump($place->lat) --}} 
							<h3 class="card-title place" id="place{{ $place->id }}">
								<input readonly hidden
								class="lat"
								value="{{ $place->lat }}"
								>
								<input readonly hidden
								class="long"
								value="{{ $place->long }}"
								>
								<input readonly hidden
								class="radius"
								value="{{-- $place->range --}}NaN"
								>
                                <input readonly hidden
								class="idev"
								value="{{ $place->id }}"
                                >
                                <input readonly hidden
								class="nom"
								value="{{ $place->nom }}"
                                >
                                <input readonly hidden
								class="placeNom"
								value="{{ $place->place }}"
								>
							</h3>
							@endforeach
						</div>
					</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- AIzaSyCbDnwlE6W0EO0LIIp16f4yqgzye78ENRY --}}
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV-FwOAdr1WGuFP1vhXI9fT4QMUvYiZnI&libraries=places&callback=initAutocomplete" async defer></script>

<script src="{{ asset('js/map_global.js') }}"></script>

@endsection
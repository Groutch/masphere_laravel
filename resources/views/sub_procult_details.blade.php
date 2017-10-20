@extends('layouts.app')

@section('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity=""/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css">

<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@endsection

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Mettre une annonce sur l'événement</h3></div>
				<div class="panel-body">
					{{-- {{ dd($guard) }} --}}
					<div class="card">
						<div class="card-block">
							@foreach( json_decode($guard->list_places) as $key => $place)
							{{-- {{ dd($place) }} --}}
							<h3 class="card-title place" id="place{{ $place->place_id }}">
								Lieu de garde à "{{ $place->name }}"	
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
								value="{{ $place->range }}"
								>
								<input readonly hidden
								class="child_nb"
								value="{{ $place->child_nb }}"
								>
							</h3>
							<div class="card-text">
								pour {{ $place->child_nb }} enfant.s
								@if(gettype($place->range) == 'number')
								, et je peux me déplacer de {{ $place->range }}km
								@endif
							</div>

							@endforeach
							{{ $guard->textbox }}
						</div>
					</div>
				</div>
		        <div id="mapid"></div>
		        <form method="post" action="/event_sub_procult/{{ $guard->id }}" class="form panel-body">
		        	{{ csrf_field() }}
				<div class="row">
                    <div class="col-xs-12 col-md-12">
                        <input
                        id="city"
                        type="text"
                        name="place"
                        class="form-control"
                        >
                    </div>
                    <input
                    id="inplat"
                    type="number"
                    step=".001"
					{{-- value="" --}}
                    style="display : none;" 
                    >
                    <input
                    id="inplong"
                    type="number"
                    step='0.001'
					{{-- value="" --}}
                    style="display : none;"
                    >
                    {{-- 
                    <input
                    id="markclicklat"
                    type="number"
                    step=".001"
					value=""
                    style="display : none;" 
                    >
                    <input
                    id="markclicklong"
                    type="number"
                    step='0.001'
					value=""
                    style="display : none;"
                    > --}}
                </div>

		        	<label title="Date et heure">Debut de garde</label>

		        	<input required readonly
		        	name="debutDate"
		        	type="date"
		        	class="form-control"
		        	placeholder="jj/mm/aaaa"
		        	aria-describedby="sizing-addon2"
		        	value="{{ date("Y-m-d", $guard->debut) }}"
		        	min="{{ date("Y-m-d", $guard->debut) }}"
		        	>
		        	<input required
		        	name="debutHeure"
		        	type="text"
		        	class="form-control"
		        	placeholder="HH:mm"
		        	aria-describedby="sizing-addon2"
		        	value="{{ date('H:i', $guard->debut) }}"
		        	>
		        	<br />

		        	<label title="Date et heure" >Fin de garde</label>

		        	<input required readonly 
		        	name="finDate"
		        	type="date"
		        	class="form-control"
		        	placeholder="jj/mm/aaaa"
		        	aria-describedby="sizing-addon2"
		        	value="{{ date("Y-m-d", $guard->fin) }}"
		        	max="{{ date("Y-m-d", $guard->fin) }}"
		        	>
		        	<input required
		        	name="finHeure"
		        	type="text"
		        	class="form-control"
		        	placeholder="HH:mm"
		        	aria-describedby="sizing-addon2"
		        	value="{{ date('H:i', $guard->fin) }}"
		        	>
		        	<br />

		        	<label title="">Commentaire/Details</label>
		        	<textarea
		        	name="textbox"
		        	type="text"
		        	class="form-control"
		        	placeholder="exemple : préciser le lieu de garde choisi, l'age des enfants, un numero de telephone, proposer des horraires semblable"
		        	aria-describedby="sizing-addon2"
		        	></textarea>
		        	<br />

		        	<input type="submit" class="btn btn-default" value="Envoyer la demande">
		        </form>
		    </div>
		</div>
	</div>
</div>
@endsection

@section('js')

<script src="{{ asset('js/sub_procult_details.js') }}" type="text/javascript" ></script>

<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV-FwOAdr1WGuFP1vhXI9fT4QMUvYiZnI&libraries=places&callback=initAutocomplete" async defer></script>


<script src="{{ asset('js/map.js') }}"></script>



@endsection
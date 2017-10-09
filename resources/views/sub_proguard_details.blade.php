@extends('layouts.app')


@section('')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity=""/>
<link rel="stylesheet" href="{{ asset('css/map.css') }}">

@endsection

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Mettre une annonce sur l'événement</h3></div>
				<form method="post" action="/event_sub_proguard/{{ $event->id }}" class="form panel-body">
					{{ csrf_field() }}

					<label title="avoir une/des adresse.s valide.s permet d'être répertorié sur la carte">Lieu de grade chez moi/Lieu de travail</label>
					<div class="place_receiver">
						<input
						id="city"
						type="text"
						class="localstorage_inp place input-group input_place form-control"
						placeholder="lieu"
						aria-describedby="sizing-addon2"
						name="list_places[0]"
						>
						<div class="row">
							<div class="col-md-4">
								<label>nombre d'enfant pour ce lieu</label>
								<input required 
								type="number"
								max="4" min="1"
								class="localstorage_inp child_nb form-control"
								placeholder="nb d'enfant max"
								aria-describedby="sizing-addon2"
								name="list_child_nbs[0]"
								>
							</div>
							<div class="col-md-8">
								<label title="rayon" >Rayon autour du lieu précédement donné où je peux garder | facultatif</label>
								<input required 
								{{-- type="number" --}}
								class="localstorage_inp form-control range"
								placeholder="rayon en km"
								max="100" min="0"
								aria-describedby="sizing-addon2"
								name="list_range[0]"
								>
							</div>
						</div>

					</div>
					{{--
					<br />
					<button type="button" class="input-group btn btn-basicfault add_place_btn">ajouter un lieu de plus</button>
					<br />
					--}}

					<label title="Date et heure">Debut de garde</label>
					<input readonly
					type="date" class="localstorage_inp form-control"
					placeholder="jj/mm/aaaa"
					aria-describedby="sizing-addon2"
					name="debutDate"
					value="{{ date("Y-m-d", $event->debut) }}"
					>
					<input required
					type="text" class="localstorage_inp form-control"
					placeholder="HH:mm"
					aria-describedby="sizing-addon2"
					name="debutHeure"
					value="{{ date('H:i', $event->debut) }}"
					>
					<br />

					<label title="Date et heure" >Fin de garde</label>
					<input readonly
					type="date"
					class="localstorage_inp form-control"
					placeholder="jj/mm/aaaa"
					aria-describedby="sizing-addon2"
					name="finDate"
					value="{{ date("Y-m-d", $event->fin) }}"
					>
					<input required
					type="text"
					class="localstorage_inp form-control"
					placeholder="HH:mm"
					aria-describedby="sizing-addon2"
					name="finHeure"
					value="{{ date('H:i', $event->fin) }}"
					>
					<br />

					<label title="">Commentaire/Details</label>
					<textarea
					type="text"
					class="localstorage_inp form-control textbox"
					placeholder="exemple : j'ai la galle mais je suis gentil (a vos risques et profits biensur)"
					aria-describedby="sizing-addon2"
					name="textbox"
					></textarea>
					<br />

					<input type="submit" class="btn btn-default" value="Créer l'annonce">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')

<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV-FwOAdr1WGuFP1vhXI9fT4QMUvYiZnI&libraries=places&callback=initAutocomplete" async defer></script>

<script src="{{ asset('js/map.js') }}"></script>

<script src="{{ asset('js/sub_proguard_details.js') }}" type="text/javascript" ></script>

@endsection
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Mettre une annonce sur l'événement</h3></div>
				<form method="post" action="/event_sub_procult/{{ $guard->id }}" class="form panel-body">
					{{ csrf_field() }}

					<label title="avoir une/des adresse.s valide.s permet d'être répertorié sur la carte">Lieu de grade chez moi/Lieu de travail</label>
					<div class="place_receiver">
						{{-- {{ dump($guard) }} --}}
						@foreach( json_decode($guard->list_places) as $key => $place)
						garde possible à {{ $place }} pour {{ json_decode($guard->list_child_nbs)[$key] }} enfant.s, et possibilité de me déplacer {{ json_decode($guard->list_range)[$key] }}km autour de ce lieu <br />
						@endforeach
					</div>
					<br />

					<label title="Date et heure">Debut de garde</label>

					<input required readonly
					type="date"
					class="form-control"
					placeholder="jj/mm/aaaa"
					aria-describedby="sizing-addon2"
					name="debutDate"
					value="{{ date("Y-m-d", $guard->debut) }}"
					min="{{ date("Y-m-d", $guard->debut) }}"
					>
					<input required
					type="text"
					class="form-control"
					placeholder="HH:mm"
					aria-describedby="sizing-addon2"
					name="debutHeure"
					value="{{ date('H:i', $guard->debut) }}"
					>
					<br />

					<label title="Date et heure" >Fin de garde</label>

					<input required readonly 
					type="date"
					class="form-control"
					placeholder="jj/mm/aaaa"
					aria-describedby="sizing-addon2"
					name="finDate"
					value="{{ date("Y-m-d", $guard->fin) }}"
					max="{{ date("Y-m-d", $guard->fin) }}"
					>
					<input required
					type="text"
					class="form-control"
					placeholder="HH:mm"
					aria-describedby="sizing-addon2"
					name="finHeure"
					value="{{ date('H:i', $guard->fin) }}"
					>
					<br />

					<label title="">Commentaire/Details</label>
					<textarea type="text" class="form-control" placeholder="exemple : préciser le lieu de garde choisi" aria-describedby="sizing-addon2" name="textbox"></textarea>
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
@endsection
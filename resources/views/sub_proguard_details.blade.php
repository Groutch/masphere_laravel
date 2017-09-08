@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Mettre une annonce sur l'événement</h3></div>
				<form method="post" action="/event_sub_proguard/{{ $event->id }}" class="form panel-body">
					{{ csrf_field() }}

					<label title="avoir une/des adresse.s valide.s permet d'être répertorié sur la carte">Lieu de grade chez moi/Lieu de travail</label>
					<div class="place_receiver">
						<input required type="text" class="place input-group input_place form-control" placeholder="lieu" aria-describedby="sizing-addon2" name="list_places[0]">
						<input type="number" max="4" min="1" class="child_nb form-control" placeholder="nb d'enfant max pour ce lieu" aria-describedby="sizing-addon2" name="list_child_nbs[0]" value="1">
						<br />
					</div>
					<button type="button" class="input-group btn btn-basicfault add_place_btn">ajouter un lieu de plus</button>
					<br />

					<label title="rayon" >Rayon autour du lieu précédement donné où je peux garder | facultatif (si vous ne gardez pas chez la famille laissez le champ vide)</label>
					<input type="text" class="form-control" placeholder="rayon en km" aria-describedby="sizing-addon2">
					<br />

					<label title="Date et heure">Debut de garde</label>
					<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debutDate" value="{{ date("Y-m-d", $event->debut) }}">
					<input required type="text" class="form-control" placeholder="HH:mm" aria-describedby="sizing-addon2" name="debutHeure" value="{{ date('H:i', $event->debut) }}">
					<br />

					<label title="Date et heure" >Fin de garde</label>
					<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="finDate" value="{{ date("Y-m-d", $event->fin) }}">
					<input required type="text" class="form-control" placeholder="HH:mm" aria-describedby="sizing-addon2" name="finHeure" value="{{ date('H:i', $event->fin) }}">
					<br />

					<label title="">Commentaire/Details</label>
					<textarea type="text" class="form-control" placeholder="exemple : j'ai la galle mais je suis gentil (a vos risques et profits biensur)" aria-describedby="sizing-addon2" name="textbox"></textarea>
					<br />

					<input type="submit" class="btn btn-default" value="Créer l'annonce">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/sub_proguard_details.js') }}" type="text/javascript" ></script>
@endsection
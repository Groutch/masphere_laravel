@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 panel panel-default">
			<div class="panel-heading"><h3>Recherche</h3></div>
			<form method="post" action="{{ route('event_search') }}" class="form panel-body">
				{{ csrf_field() }}
				<label title="Nommer l'événement" >Nom</label>
				<input required type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom">
				<br />

				<label title="Date et heure" >Debut</label>
				<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debutDate" value="<?php echo date("Y-m-d", time()+7200); ?>">
				<br />

				<label title="Date et heure" >Fin</label>
				<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="finDate" value="<?php echo date("Y-m-d", time()+7200); ?>">
				<br />

				<label title="Url valide" >Lien vers la billetterie | facultatif</label>
				<input type="url" class="form-control" placeholder="http://example.com/billetterie" aria-describedby="sizing-addon2" name="billetterie">
				<br />

				<label title="">Groupes | facultatif</label>
				<div class="group_receiver">
					<input type="text" class="input-group input_group form-control" placeholder="nom du groupe" aria-describedby="sizing-addon2" name="liste_groupes[0]">
				</div>

				<button type="button" class="input-group btn btn-basicfault add_group_btn">ajouter un groupe de plus</button>
				<br />

				<input type="submit" class="btn" value="Créer l'événement">
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/event_creation.js') }}" type="text/javascript" ></script>
@endsection
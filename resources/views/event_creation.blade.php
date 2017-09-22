@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Nouvel événement</h3></div>
				<form method="post" action="{{ route('event_post') }}" class="form panel-body">
					{{ csrf_field() }}
					<label title="Nommer l'événement" >Nom</label>
					<input required type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom" value="{{ old('nom') }}">
					<br />
					
					<label title="Utiliser l'autocomplétion pour avoir une adresse valide" >Lieu</label>
					<input required type="text" class="form-control" placeholder="lieu" aria-describedby="sizing-addon2" name="place" value="{{ old('place') }}">
					<br />

					<label title="Date et heure" >Debut</label>
					<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debutDate" value="<?php
					if(!old('debutDate')){
						echo date("Y-m-d", time()+7200);
					}else{
						echo old('debutDate');
					}
					?>">
					<input required type="text" class="form-control" placeholder="HH:mm" aria-describedby="sizing-addon2" name="debutHeure" value="<?php
					if(!old('debutHeure')){
						echo date('H:i', time()+7200);
					}else{
						echo old('debutHeure');
					}
					?>">
					<br />

					<label title="Date et heure" >Fin</label>
					<input required type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="finDate" value="<?php 
					if(!old('finDate')){
						echo date("Y-m-d", time()+7200);
					}else{
						echo old('finDate');
					}
					?>">
					<input required type="text" class="form-control" placeholder="HH:mm" aria-describedby="sizing-addon2" name="finHeure" value="<?php
					if(!old('finheure')){
						echo date('H:i', time()+7200);
					}else{
						echo old('debutHeure');
					}
					?>">
					<br />

					<label title="Url valide" >Lien vers la billetterie | facultatif</label>
					<input type="url" class="form-control" placeholder="http://example.com/billetterie" aria-describedby="sizing-addon2" name="billetterie">
					<br />

					<label title="">Style musical | facultatif</label>
					<input type="text" class="form-control" placeholder="stylemusical" aria-describedby="sizing-addon2" name="stylemusical">
					<br />

					<label title="">Commentaire | facultatif</label>
					<textarea type="text" class="form-control" placeholder="Commentaire" aria-describedby="sizing-addon2" name="textbox"></textarea>
					<br />

					<label title="">Spectacle | facultatif</label>
					<div class="perform_receiver">
						<input
						type="text"
						class="input-group input_group form-control"
						placeholder="nom du spectacle"
						aria-describedby="sizing-addon2"
						name="list_performs[0]"
						value="{{ old('list_performs')[0] }}"
						>
						@if( old('list_performs') )
						@php
						$old = old('list_performs');
						$listTemp = array_shift($old);
						@endphp
						@foreach($old as $key => $perform)
						<div class="input-group input_group">
							<input
							type="text"
							class="input-group input_group form-control"
							placeholder="nom du spectacle"
							aria-describedby="sizing-addon2"
							name="list_performs[{{ $key }}]"
							value="{{ $old[$key] }}"
							>
							<span class="input-group-btn"><button type="button" class="input-group btn btn-danger suppr_perform_btn">suppr</button></span>
						</div>
						@endforeach
						@endif
					</div>
					<button type="button" class="input-group btn btn-basicfault add_perform_btn">ajouter un spectacle de plus</button>
					<br />

					<input type="submit" class="btn" value="Créer l'événement">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/event_creation.js') }}" type="text/javascript" ></script>
@endsection
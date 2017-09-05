@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<form method="get" action="{{ route('event_search') }}" class="form panel-body">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-xs-8 col-md-8">
							<label title="Nommer l'événement" >Nom</label>
							<input type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom">
							<br />
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<label title="Date et heure" >Du</label>
									<input type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debut" value="<?php echo date("Y-m-d", time()+7200); ?>">
									<br />
								</div>

								<div class="col-xs-12 col-md-6">
									<label title="Date et heure" >Au</label>
									<input type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="fin" value="">
									<br />
								</div>
							</div>
						</div>
						
						<div class="col-xs-4 col-md-4">
							<a href="" title="voir la carte" class="form-control btn btn-default" >Voir la carte</a>
						</div>
					</div>
					<div class="row">
					<div class="col-xs-8 col-md-12">
							
							<label title="">Groupe</label>
							<input type="text" class="input-group input_group form-control" placeholder="nom du groupe" aria-describedby="sizing-addon2" name="liste_groupes[0]">
							<br />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8 col-md-4 col-md-offset-4">
							<button type="submit" class="form-control btn btn-default" ><span class="glyphicon glyphicon-search" ></span>recherche</button>
						</div>
					</div>
				</form>
			</div>
			<hr />
			<div class="panel-heading"><h3>Tous les événements</h3></div>
			<div class="row">
				<div class="panel-body">
					@foreach ($events as $event)
					<div class="col-xs-12 col-md-6 col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">{{ $event->nom }}</div>
							<div class="panel-body">
								@if(date( 'y-d-m',$event->debut) === date( 'y-d-m',$event->fin))
								le {{ date( 'd/m/Y', $event->debut) }} de
								{{ date( 'h:i', $event->debut) }} à
								{{ date( 'h:i', $event->fin) }}
								@else
								du {{ date( 'd/m/Y h:i', $event->debut) }}
								au {{ date( 'd/m/Y h:i', $event->fin) }}
								@endif
								<div>commentaire : {{ $event->textbox }}</div>
							</div>
							@if ($event->stylemusical && $event->billetterie)
							<div class="panel-footer">
								<div>style : {{ $event->stylemusical }}</div>
								@if($event->billetterie)
								<a href="{{ $event->billetterie }}">Billetterie</a>
								@endif
							</div>
							@endif
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/event_search.js') }}"></script>
@endsection
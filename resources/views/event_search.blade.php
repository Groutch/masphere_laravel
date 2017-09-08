@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">recherche</div>
				{{-- <form method="get" action="{{ route('event_search') }}" class="form"> --}}
				{{-- {{ csrf_field() }} --}}
				<div class="panel-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Nommer l'événement" >Nom</label>
							<input id="search_text_input" type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom">
							<br />
						</div>
						
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Date et heure" >Commence au plus tôt</label>
							<input id="search_debut" type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debut" value="<?php echo date("Y-m-d", time()+7200); ?>">
							<br />
						</div>
						
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Date et heure" >Fini au plus tard</label>
							<input id="search_fin" type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="fin" value="">
							<br />
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="">Groupe</label>
							<input id="" type="text" class="input-group input_group form-control" placeholder="nom du groupe" aria-describedby="sizing-addon2" name="liste_groupes[0]">
							<br />
						</div>
					</div>
					{{-- <div class="row">
						<div class="col-xs-5 col-md-4">
							<button type="submit" title="voir la recherche dans une liste" class="form-control btn btn-default" ><span class="glyphicon glyphicon-search" ></span>recherche</button>
						</div>
						<div class="col-xs-5 col-md-4">
							<button type="submit" title="voir la recherche sur la carte" class="form-control btn btn-default" ><span class="glyphicon glyphicon-map-marker" ></span>Voir la carte</button>
						</div>
					</div> --}}
				</div>
				{{-- </form> --}}
			</div>
			<hr />
			<div class="panel panel-default">
				<div class="panel-heading"><h3 id="allornot">Tous les événements</h3></div>
				<div class="row">
					<div class="panel-body">
						@foreach ($events as $event)
						<div class="col-xs-12 col-md-6 col-lg-4 event" data-name="{{ $event->nom }}" data-debut="{{ date( 'Y-m-d', $event->debut) }}" data-fin="{{ date('Y-m-d', $event->fin) }}" >
							<div class="panel panel-default">
								<div class="panel-heading">{{ $event->nom }}</div>
								<div class="panel-body">
									@if(date( 'd/m/Y', $event->debut) === date( 'd/m/Y', $event->fin))
									le {{ date( 'd/m/Y', $event->debut) }} de
									{{ date( 'h:i', $event->debut) }} à
									{{ date( 'h:i', $event->fin) }}
									@else
									du {{ date( 'd/m/Y à h:i', $event->debut) }}
									au {{ date( 'd/m/Y à h:i', $event->fin) }}
									@endif
									<div>commentaire : {{ $event->textbox }}</div>
								</div>

								<div class="panel-footer">
									@if(Auth::user()->roles->implode('slug')=='procult' || Auth::user()->roles->implode('slug')=='proguard')
									<a class="btn btn-default" href="/event_details/{{ $event->id }}">Détails</a>
									@elseif(Auth::user()->roles->implode('slug')=='orga')
									<a class="btn btn-default" href="/event_details_orga/{{ $event->id }}">Détails</a>
									@endif
								</div>
							</div>
						</div>
						@endforeach
						<div class="col-xs-12 col-md-12 col-lg-4" id="no-event-found" hidden>
							aucun événement trouvé
						</div>
					</div>
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
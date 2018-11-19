@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">recherche
					{{-- {{ Auth::user()->roles->implode('slug') }} --}}
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Nommer l'événement" >Nom</label>
							<input id="search_text_input" type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom">
							<br />
						</div>
						
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Date" >Commence au plus tôt</label>
							<input id="search_debut" type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debut" value="<?php echo date("Y-m-d", time()+7200); ?>">
							<br />
						</div>
						
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="Date" >Fini au plus tard</label>
							<input id="search_fin" type="date" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="fin" value="">
							<br />
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-xs-12">
							<label title="">Artistes/Performers</label>
							<input id="" type="text" class="input-group input_group form-control" placeholder="nom de l'artiste/performers" aria-describedby="sizing-addon2">
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
				<a href="#results"><button type="submit" id="event" class="btn btn-primary">Rechercher</button></a>
			{{-- </form> --}}
		</div>
		<hr />
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 id="allornot">Résultats de votre recherche</h3>
			</div>
			<div class="row">
				<div class="panel-body" id="results">
					@foreach ($events as $key => $event)
					<div class="card event" data-name="{{ $event->nom }}" data-debut="{{ date( 'Y-m-d', $event->debut) }}" data-fin="{{ date('Y-m-d', $event->fin) }}" >
						<div class="card-block">
							<h3 class="card-title">{{ $event->nom }}</h3>
							<div class="card-text">
								@if(date( 'd/m/Y', $event->debut) === date( 'd/m/Y', $event->fin))
								le {{ date( 'd/m/Y', $event->debut) }} de
								{{ date( 'H:i', $event->debut) }} à
								{{ date( 'H:i', $event->fin) }}
								@else
								du {{ date( 'd/m/Y à H:i', $event->debut) }}
								au {{ date( 'd/m/Y à H:i', $event->fin) }}
								@endif
								<div>commentaire : {{ $event->textbox }}</div>

								@if(Auth::user()->roles->implode('slug')=='procult')
								<a class="btn btn-default" id="event{{ $event->id }}" href="/event_details_procult/{{ $event->id }}">Détails ({{ $guards_nb[$key] }} garde
									@if($guards_nb[$key]>1)
									s
									@endif
								)</a>
								@elseif(Auth::user()->roles->implode('slug')=='proguard')
								<a class="btn btn-default" id="event{{ $event->id }}" href="/event_details_{{Auth::user()->roles->implode('slug')}}/{{ $event->id }}">Détails</a>
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
@endsection

@section('js')
<script src="{{ asset('js/event_search.js') }}"></script>
@endsection
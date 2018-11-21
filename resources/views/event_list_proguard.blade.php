@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<!-- ALED DASHBOARD PROFIL -->
				<div class="panel-body">
					<div class="card">
						<div class="card-block">
							<h3 class="card-title">
								@if(Auth::user()->id!=$infoUser->id)
								Profil de {{ $infoUser->name }}
								@else
								Mon profil <a href="/edit/account"><button class="btn btn-info">Editer mon compte</button></a>
								@endif
							</h3>
							<div class="card-text">
								<p> {{$infoUser->roles[0]->name}} - {{ $infoUser->email}}</p>
								<p>Trouvez ci-dessous les évènements auxquels je suis attaché :</p>
							</div>
						</div>
					</div>
					@if($infoUser->roles[0]->name=="pro de la guarde")
					@foreach ($guards as $key => $guard)
					<div class="card guard">
						<div class="card-block">
							<input hidden
							type="text"
							id="statutguard{{ $guard->id }}"
							class="statut"
							datastatut="{{ $guard->statut }}"
							>
							@if($guard->statut == 4)
							<div dataid="{{ $guard->id }}" class="eventSuppr">{{ date( 'd/m/Y', $guard->debut) }}, événement supprimé, garde annulée</div>
							@else
							<h3 class="card-title"><label for="">{{ $guard->events[0]->nom }}</label>, le {{ date( 'd/m/Y', $guard->debut) }}</h3>
							<div class="card-text">
								@if(date( 'd/m/Y', $guard->debut) === date( 'd/m/Y', $guard->fin))
								de {{ date( 'H:i', $guard->debut) }} à {{ date( 'H:i', $guard->fin) }}
								@else
								{{ date( 'à H:i', $guard->debut) }}
								au {{ date( 'd/m/Y à H:i', $guard->fin) }}
								@endif
								<br />
								| 
								@foreach(json_decode($guard->list_places) as $place)
								{{ $place->name }} | 
								@endforeach
								<div>
									<a class="btn btn-default" href="/guard_details_pro/{{ $guard->id }}">Détails</a>
									<a class="btn btn-danger" href="/guard_delete/{{$guard->id}}">Supprimer ma garde</a>
								</div>
							</div>
							@endif
						</div>
					</div>
					@endforeach
					@else
					@foreach ($tab as $key => $event)
					<div class="card guard">
						<div class="card-block">
							<input hidden
							type="text"
							id="statutguard{{ $event->id }}"
							class="statut"
							datastatut="{{ $event->statut }}"
							>
							<h3 class="card-title"><label for="">{{ $event->nom }}</label>, le {{ date( 'd/m/Y', $event->debut) }}</h3>
							<div class="card-text">
								@if(date( 'd/m/Y', $event->debut) === date( 'd/m/Y', $event->fin))
								de {{ date( 'H:i', $event->debut) }} à {{ date( 'H:i', $event->fin) }}
								@else
								{{ date( 'à H:i', $event->debut) }}
								au {{ date( 'd/m/Y à H:i', $event->fin) }}
								@endif
								<br />
								| 
								{{ $event->place }} | 
								<div>
									<a class="btn btn-default" href="/guard_details_pro/{{ $event->id }}">Détails</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/event_list_proguard.js') }}"></script>
@endsection

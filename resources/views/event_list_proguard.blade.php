@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<!-- ALED DASHBOARD PROFIL -->
				<a href="/edit/account"><button class="btn btn-primary">Editer mon compte</button></a>
				<div class="panel-body">
					<div class="card">
						<div class="card-block">
							<h3 class="card-title">Profil de {{ Auth::user()->name }}</h3>
                            <div class="card-text">
							<p> {{Auth::user()->roles[0]->name}} - {{ Auth::user()->email}}</p>
							
                            </div>
						</div>
					</div>
				<div class="panel-heading"><h3>Vos gardes</h3></div>
				{{-- {{dd($guards)}} --}}
					@foreach ($guards as $key => $guard)
					<div class="card guard">
						<div class="card-block">
						{{-- {{dd($guard->events[0])}} --}}
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
									<a class="btn btn-default" href="guard_details_pro/{{ $guard->id }}">Détails</a>
								</div>
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
@endsection

@section('js')
	<script src="{{ asset('js/event_list_proguard.js') }}"></script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Vos gardes</h3></div>
				<div class="panel-body">
				{{-- {{dd($guards)}} --}}
					@foreach ($guards as $key => $guard)
					<div class="card guard">
						<div class="card-block">
							<div class="card-title"><label for="">{{ $events[$key] }}</label>, le {{ date( 'd/m/Y', $guard->debut) }}</div>
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
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

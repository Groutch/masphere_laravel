@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="card">
						<div class="card-block">
							<h3 class="card-title">{{ $event->nom }} de {{ $event->users[0]->name }}</h3>
							<div class="card-text">
								@if(date('d/m/Y', $event->debut) === date('d/m/Y', $event->fin))
								Le {{ date( 'd/m/Y', $event->debut) }} 
								@if (date( 'H:i', $event->debut) !== date( 'H:i', $event->fin))
								de
								@endif
								{{ date( 'H:i', $event->debut) }}
								@if (date( 'H:i', $event->debut) !== date( 'H:i', $event->fin))
								à {{ date( 'H:i', $event->fin) }}
								@endif
								@else
								Du {{ date( 'd/m/Y à H:i', $event->debut) }}
								au {{ date( 'd/m/Y à H:i', $event->fin) }}
								@endif
								<br />
								<br />
								@if ($event->list_performs)
								<div>
									| @foreach(json_decode($event->list_performs) as $group)
									{{ $group }} | 
									@endforeach
								</div>
								@endif
								<br />

								<div>{{ $event->textbox }}</div>
							</div>
							<a class="btn btn-default" href="{{ $event->billetterie }}" target="_blank">BILLETTERIE</a>
							@if(count($guards))
							<hr />
							<div class="row">
								@foreach ($guards as $key => $guard)
								<div class="panel panel-default col-md-3">
									{{-- {{ $guard->users[0]->name }} <br />  --}}
									@if(count($guard->list_places)>1)
										@foreach ($guard->list_places as $place)
											{{ $place->name }} <br /> 
										@endforeach
									@else
										{{ $guard->list_places[0]->name }} <br /> 
									@endif
									@if(count($guard->users)>1)
										({{ count($guard->users)-1 }} personne.s en attente)
										<br /> 
									@endif
									<a class="event_sub_procult btn btn-default" href="/event_sub_details_procult/{{ $guard->id }}">S'inscrire</a>
								</div>
								@endforeach
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
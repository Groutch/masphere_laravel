@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $event->nom }} de {{ $event->users[0]->name }}</div>
				<div class="panel-body">
					@if(date('d/m/Y', $event->debut) === date('d/m/Y', $event->fin))
						Le {{ date( 'd/m/Y', $event->debut) }} 
						@if (date( 'h:i', $event->debut) !== date( 'h:i', $event->fin))
							de
						@endif
						{{ date( 'h:i', $event->debut) }}
						@if (date( 'h:i', $event->debut) !== date( 'h:i', $event->fin))
							à {{ date( 'h:i', $event->fin) }}
						@endif
					@else
						Du {{ date( 'd/m/Y à h:i', $event->debut) }}
						au {{ date( 'd/m/Y à h:i', $event->fin) }}
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
				<div class="panel-footer">
					<a class="btn btn-default" href="{{ $event->billetterie }}" target="_blank">BILLETTERIE</a>
					<hr />
					<div class="row">
						@foreach ($guards as $key => $guard)
							<div class="panel panel-default col-md-3">
								<div class="panel-heading">{{ $guard[0]->name }}</div>
								<a id="event_sub_procult" class="btn btn-default" href="/event_sub_details_procult/{{ $guards_ids[$key] }}">S'inscrire</a>
								@if (count($guard[1]))
									<div class="panel-body">
										{{ $guard[1] }}
									@foreach ($guard[1] as $user)
										{{ $user->name }} <br />
									@endforeach
									</div>
								@endif
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
@endsection
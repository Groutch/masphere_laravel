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
						à
						{{ date( 'h:i', $event->fin) }}
						@endif
					@else
					Du {{ date( 'd/m/Y à h:i', $event->debut) }}
					au {{ date( 'd/m/Y à h:i', $event->fin) }}
					@endif
					<br />
					<br />
					<div>
						| 
						@foreach(json_decode($event->list_groups) as $group)
						{{ $group }} | 
						@endforeach
					</div>
					<br />

					<div>{{ $event->textbox }}</div>
				</div>
				<div class="panel-footer">
					<a id="event_sub_procult" class="btn btn-default" href="{{ $event->billetterie }}" target="_blank" >BILLETTERIE</a>
					@if (Auth::user()->roles->implode('slug')=='procult')
						{{-- @foreach ($event->pros as $pro) --}}
							{{-- expr --}}
						{{-- @endforeach --}}
					@elseif(Auth::user()->roles->implode('slug')=='proguard')
						<a id="event_sub_proguard" class="btn btn-default" href="/event_sub_details_proguard/{{ $event->id }}">S'inscrire</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
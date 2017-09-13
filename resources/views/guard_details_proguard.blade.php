@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ date('d/m/Y', $guard->debut) }}</div>
				<div class="panel-body">
					@if(date('d/m/Y', $guard->debut) === date('d/m/Y', $guard->fin))
					Le {{ date( 'd/m/Y', $guard->debut) }} 
						@if (date( 'h:i', $guard->debut) !== date( 'h:i', $guard->fin))
						de
						@endif
					{{ date( 'h:i', $guard->debut) }}
						@if (date( 'h:i', $guard->debut) !== date( 'h:i', $guard->fin))
						à
						{{ date( 'h:i', $guard->fin) }}
						@endif
					@else
					Du {{ date( 'd/m/Y à h:i', $guard->debut) }}
					au {{ date( 'd/m/Y à h:i', $guard->fin) }}
					@endif
					<br />
					<br />

					<div>lieu(x) de garde :
						| 
						@foreach(json_decode($guard->list_places) as $key => $place)
						{{ $place }}, avec {{ json_decode($guard->list_child_nbs)[$key] }} enfant(s), et je peux garder a {{ json_decode($guard->list_range)[$key] }}km de {{ $place }} | 
						@endforeach
					</div>
					<br />
					@if ($guard->textbox)
					<div>commentaire : {{ $guard->textbox }}</div>
					@endif
				</div>
				<div class="panel-footer">
					<div>date de création : {{ $guard->created_at }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
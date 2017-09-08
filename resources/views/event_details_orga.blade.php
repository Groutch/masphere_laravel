@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $event->nom }}</div>
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

					<div>groupes :
						| 
						@foreach(json_decode($event->list_groups) as $group)
						{{ $group }} | 
						@endforeach
					</div>
					<br />
					@if ($event->textbox)
					<div>commentaire : {{ $event->textbox }}</div>
					@endif
				</div>
				<div class="panel-footer">
					<div>lien billetterie : <a  href="{{ $event->billetterie }}" target="_blank" >{{ $event->billetterie }}</a> </div>
					<div>style : {{ $event->stylemusical }}</div>
					<div>date de création : {{ $event->created_at }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
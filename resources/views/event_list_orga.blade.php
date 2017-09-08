@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Vos événement</h3></div>
				<div class="row">
					<div class="panel-body">
						@foreach ($events as $event)
						<div class="col-xs-12 col-md-6 col-lg-4 event">
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
									@if ($event->textbox)
									<div>commentaire : {{ $event->textbox }}</div>
									@endif
								</div>
								<div class="panel-footer">
									<a class="btn btn-default" href="event_details_orga/{{ $event->id }}">Détails</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

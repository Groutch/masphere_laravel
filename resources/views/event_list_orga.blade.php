@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Vos événement</h3></div>
				<div class="row">
					<div class="panel-body">
						@foreach ($events as $event)
						<div class="col-xs-12 col-md-6 col-lg-4 event">
							<div class="card">
								<div class="card-block">
									<h3 class="card-title">
										{{ $event->nom }}
										<a href="{{ route('event_edit', $event->id) }}"><span class="fa fa-pencil"></span></a>
									</h3>
									<div class="card-text">
										@if(date( 'd/m/Y', $event->debut) === date( 'd/m/Y', $event->fin))
										le {{ date( 'd/m/Y', $event->debut) }} de
										{{ date( 'H:i', $event->debut) }} à
										{{ date( 'H:i', $event->fin) }}
										@else
										du {{ date( 'd/m/Y à H:i', $event->debut) }}
										au {{ date( 'd/m/Y à H:i', $event->fin) }}
										@endif
										@if ($event->textbox)
										<div>commentaire : {{ $event->textbox }}</div>
										@endif
										<a class="btn btn-default" href="event_details_orga/{{ $event->id }}">Détails</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					@if($events)
					@else
					<div class="col-xs-12 col-md-12 col-lg-4" id="no-event-found">
						aucun événement trouvé
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

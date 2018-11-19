@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>
				@if(Auth::user()->id==$infoUser->id)
				Vos événement <a href="/edit/account"><button class="btn btn-info">Editer mon compte</button></a>
				@else
				Les évènements de {{$infoUser->name}}
				@endif
			</h3></div>
				<div class="row">
					<div class="panel-body">
						@foreach ($events as $event)
						<div class="col-xs-12 col-md-6 col-lg-4 event">
							<div class="card">
								<div class="card-block">
									<h3 class="card-title">
										{{ $event->nom }}
										@if(Auth::user()->id==$infoUser->id)
										<span class="fa fa-times text-danger deleteEvent" id="deleteEvent{{$event->id}}" dataeventid="{{$event->id}}"></span>
										@endif
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
										@if(Auth::user()->id==$infoUser->id)
										<a class="btn btn-default" href="{{route('event_details_orga', ['id'=>$event->id])}}">Détails</a>
										{{-- <a class="btn btn-default" href="event_details_orga/{{ $event->id }}">Détails</a> --}}
										<a class="btn btn-warning" href="{{ route('event_edit', $event->id) }}">
											Edit
										</a>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="modal fade" id="modal{{$event->id}}" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h3 class="modal-title"><span class="text-danger">Supprimer</span> {{$event->nom}}?</h3>
									</div>
									<div class="modal-body">
										<a
										href="{{route('event_delete', ['id'=>$event->id])}}"
										type="button"
										class="btn btn-danger"
										id='modalSubmitEvent{{$event->id}}'>
										Valider</a>
										<button
										type="button"
										class="btn btn-default"
										data-dismiss="modal"
										id='modalCancel{{$event->id}}'>
										Annuler</button>
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

@section('js')
<script src="{{asset('js/event_list_orga.js')}}"></script>
@endsection
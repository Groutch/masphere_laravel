@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="card">
						<div class="card-block">
							<h3 class="card-title">{{ $event->nom }}</h3>
							<div class="card-text">
								@if(date('d/m/Y', $event->debut) === date('d/m/Y', $event->fin))
								Le {{ date( 'd/m/Y', $event->debut) }} 
								@if (date( 'H:i', $event->debut) !== date( 'H:i', $event->fin))
								de
								@endif
								{{ date( 'H:i', $event->debut) }}
								@if (date( 'H:i', $event->debut) !== date( 'H:i', $event->fin))
								à
								{{ date( 'H:i', $event->fin) }}
								@endif
								@else
								Du {{ date( 'd/m/Y à H:i', $event->debut) }}
								au {{ date( 'd/m/Y à H:i', $event->fin) }}
								@endif
								<br />
								<br />

								<div>Spectacles :
									| 
									@foreach(json_decode($event->list_performs) as $group)
									{{ $group }} | 
									@endforeach
								</div>
								<br />
								@if ($event->textbox)
								<div>commentaire : {{ $event->textbox }}</div>
								@endif
								<div>lien billetterie : <a  href="{{ $event->billetterie }}" target="_blank" >{{ $event->billetterie }}</a> </div>
								<div>style : {{ $event->stylemusical }}</div>
								<div>date de création : {{ $event->created_at }}</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="panel-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
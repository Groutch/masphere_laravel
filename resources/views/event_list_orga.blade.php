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
						<div class="col-xs-12 col-md-6 col-lg-4">
							<div class="panel panel-default">
								<div class="panel-heading">{{ $event->nom }}</div>
								<div class="panel-body">
									@if(date( 'y-d-m',$event->debut) === date( 'y-d-m',$event->fin))
									le {{ date( 'd/m/Y',$event->debut) }} de
									{{ date( 'h:i',$event->debut) }} à
									{{ date( 'h:i',$event->fin) }}
									@else
									du {{ date( 'd/m/Y h:i',$event->debut) }}
									au {{ date( 'd/m/Y h:i',$event->fin) }}
									@endif
									<div>commentaire : {{ $event->textbox }}</div>
								</div>
								@if ($event->stylemusical && $event->billetterie)
								<div class="panel-footer">
									<div>style : {{ $event->stylemusical }}</div>
									@if($event->billetterie)
									<a href="{{ $event->billetterie }}">Billetterie</a>
									@endif
								</div>
								@endif
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

@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Vos gardes</h3></div>
				<div class="row">
					<div class="panel-body">
						@foreach ($guards as $key => $guard)
						<div class="col-xs-12 col-md-6 col-lg-4 guard">
							<div class="panel panel-default">
								<div class="panel-heading">Le {{ date( 'd/m/Y', $guard->debut) }} sur l'événement : {{ $events[$key] }}</div>
								<div class="panel-body">
									@if(date( 'd/m/Y', $guard->debut) === date( 'd/m/Y', $guard->fin))
									de {{ date( 'h:i', $guard->debut) }} à {{ date( 'h:i', $guard->fin) }}
									@else
									{{ date( 'à h:i', $guard->debut) }}
									au {{ date( 'd/m/Y à h:i', $guard->fin) }}
									@endif
									@if ($guard->textbox)
									<div>commentaire : {{ $guard->textbox }}</div>
									@endif
								</div>
								<div class="panel-footer">
									<a class="btn btn-default" href="guard_details_proguard/{{ $guard->id }}">Détails</a>
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

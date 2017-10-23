@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
			<div class="panel-body">
			{{-- {{ dd($guard) }} --}}
					<div class="card">
						<div class="card-block">
							<h3 class="card-title"><label>Garde du {{ date('d/m/Y', $guard->debut) }}</label></h3>
							<div class="card-text">
								@if(date('d/m/Y', $guard->debut) === date('d/m/Y', $guard->fin))
									Le {{ date( 'd/m/Y', $guard->debut) }} 
									@if (date( 'H:i', $guard->debut) !== date( 'H:i', $guard->fin))
									de
									@endif
									{{ date( 'H:i', $guard->debut) }}
									@if (date( 'H:i', $guard->debut) !== date( 'H:i', $guard->fin))
									à
									{{ date( 'H:i', $guard->fin) }}
									@endif
								@else
									Du {{ date( 'd/m/Y à H:i', $guard->debut) }}
									au {{ date( 'd/m/Y à H:i', $guard->fin) }}
								@endif
								<div><label>lieu(x) de garde</label> : <br />
									| 
									@foreach(json_decode($guard->list_places) as $key => $place)
									{{ $place->name }}, avec {{ $place->child_nb }} enfant(s) 
									@if(gettype($place->range) == 'number')
									, et je peux me déplacer de {{ $place->range }}km
									@endif
									| 
									@endforeach
								</div>
								@if ($guard->textbox)
									<div><label for="">commentaire : </label><br />{{ $guard->textbox }}</div><br />
								@endif
								{{-- <div>date de création : {{ $guard->created_at }}</div> --}}

								@if(count($guard->urequests))
									<div class="card">
										@if(Auth::User()->roles->implode('slug') == 'proguard')
											<label>Propositions pour cette garde</label>
										@else
											<label>Votre proposition pour cette garde</label>
										@endif
									@foreach ($guard->urequests as $urequest)
									{{dd($urequest)}}
										@if(Auth::User()->roles->implode('slug') == 'proguard' || Auth::User()->id == $urequest->users[0]->id)

										<div class="card">
											Le {{ date( 'd/m/Y', $urequest->debut) }} 
											@if(date( 'd/m/Y', $urequest->debut) === date( 'd/m/Y', $urequest->fin))
												de {{ date( 'H:i', $urequest->debut) }} à {{ date( 'H:i', $urequest->fin) }}
											@else
												{{ date( 'à H:i', $urequest->debut) }}
												au {{ date( 'd/m/Y à H:i', $urequest->fin) }}
											@endif
											@if ($guard->textbox)
												<div>commentaire : {{ $urequest->textbox }}</div>
											@endif
										</div>
										@endif
									@endforeach
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
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
								<?php 
								$guardname=explode('/',$guard->textbox)[0];
								$guardcom=explode('/',$guard->textbox)[1];
								$guardid=explode('/',$guard->textbox)[2];
								?>
								<div><label for="">commentaire du créateur :  <a href="<?php echo '/profil/'.$guardid ?>"><strong>{{$guardname}}</strong></a> : </label><br />{{ $guardcom }}</div><br />
								@endif
								@if($guard->urequests)
								<div class="card">
									@if(Auth::User()->roles->implode('slug') == 'proguard')
									@if (count($guard->urequests))
									<label>Propositions pour cette garde</label>
									@endif
									@else
									@if (count($guard->urequests))
									<label>Votre proposition pour cette garde</label>
									@endif
									@endif
									@foreach ($guard->urequests as $urequest)
									{{-- {{dd($urequest->guards->first()->users->first()->id)}} --}}
									@if(Auth::User()->roles->implode('slug') == 'proguard' || Auth::User()->id == $urequest->user_id)
									<div class="card">
										Le {{ date( 'd/m/Y', $urequest->debut) }} 
										@if(date( 'd/m/Y', $urequest->debut) === date( 'd/m/Y', $urequest->fin))
										de {{ date( 'H:i', $urequest->debut) }} à {{ date( 'H:i', $urequest->fin) }}
										@else
										{{ date( 'à H:i', $urequest->debut) }}
										au {{ date( 'd/m/Y à H:i', $urequest->fin) }}
										@endif
										@if ($guard->textbox)
										<?php 
										$name=explode('/',$urequest->textbox)[0];
										$com=explode('/',$urequest->textbox)[1];
										$iduser=explode('/',$urequest->textbox)[2];
										?>
										<div>commentaire de <a href="<?php echo '/profil/'.$iduser ?>"><strong>{{ $name }}</strong></a> : <p>{{ $com }}</p>
											@if($guardname==Auth::user()->name && $urequest->statut==null)
											<form action="/accept/{{$urequest->id}}" method="POST">
												{{ csrf_field() }}
												<input type="text" hidden value={{$guard->id}} id="guard" name="guard">
												<button class="btn btn-success" type='submit'>Accepter la demande</button>
											</form>
											<form action="/reject/{{$urequest->id}}" method="POST">
												{{ csrf_field() }}
												<input type="text" hidden value={{$guard->id}} id="guard" name="guard">
												<button class="btn btn-danger" type="submit">Refuser la demande</button>
											</form>
											@endif
											@if($urequest->statut==2)
											<label><h4>Demande acceptée</h4></label>
											@elseif($urequest->statut==1)
											<label><h4>Demande refusée</h4></label>
											@endif
										</div>
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
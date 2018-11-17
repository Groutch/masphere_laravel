@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="card">
						<div class="card-block">
							@if (Auth::user()->id == $infoUser->id)
							<h3 class="card-title">Mon Profil</h3>
							<a href="/edit/account"><button class="btn btn-primary">Editez mon compte</button></a>
							@else
							<h3 class="card-title">Profil de {{ $infoUser->name }}</h3>
							@endif
							
                            <div class="card-text">
                                <p>{{$roleName}} - {{ $infoUser->email}}</p>
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
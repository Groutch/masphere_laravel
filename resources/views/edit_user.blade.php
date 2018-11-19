@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<form action="/edit/account" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="name">Nom Prénom</label>
						<input type="text" name="name" class="form-control" value="{{$user->name}}" id="name">
					</div>
					<div class="form-group">
						<label for="email">Mon email</label>
						<input type="email" class="form-control" name="email" value="{{$user->email}}" id="email">
					</div>
					<div class="form-group">
						<label for="checkpass">Mot de passe actuel</label>
						<input type="password" class="form-control" name="checkpass" placeholder="Mot de passe actuel" id="checkpass">
					</div>
					<div class="form-group">
						<label for="newpass">Nouveau mot de passe</label>
						<input type="password" name="newpass" class="form-control" placeholder="Nouveau mot de passe" id="newpass">
					</div>
					<div class="form-group">
						<button type="submit" class='btn btn-info'>Changer mes informations</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
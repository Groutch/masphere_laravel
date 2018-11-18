@extends('layouts.app')

@section('content')
<div class="container">
	<div class="pagecontainer row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<form action="/edit/account" method="POST">
					{{ csrf_field() }}
					<input type="text" name="name" value="{{$user->name}}" id="name">
					<input type="email" name="email" value="{{$user->email}}" id="email">
					<input type="password" name="checkpass" placeholder="Mot de passe actuel" id="checkpass">
					<input type="password" name="newpass" placeholder="Nouveau mot de passe" id="newpass">
					<button type="submit">Changer mes informations</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
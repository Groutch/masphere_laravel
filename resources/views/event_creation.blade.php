@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><h3>Nouvel événement</h3></div>

				<div class="panel-body">
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Nom</label>
						<input type="text" class="form-control" placeholder="nom de l'événement" aria-describedby="sizing-addon2" name="nom">
					{{-- </div> --}}
					<br />
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Lieu</label>
						<input type="text" class="form-control" placeholder="lieu" aria-describedby="sizing-addon2">
					{{-- </div> --}}
					<br />
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Debut</label>
						<input type="text" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="debut">
					{{-- </div> --}}
					<br />
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Fin</label>
						<input type="text" class="form-control" placeholder="jj/mm/aaaa" aria-describedby="sizing-addon2" name="fin">
					{{-- </div> --}}
					<br />
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Lien vers l'achat des places | facultatif</label>
						<input type="text" class="form-control" placeholder="stylemusical" aria-describedby="sizing-addon2" name="stylemusical">
					{{-- </div> --}}
					<br />
					{{-- <div class="input-group"> --}}
						<label id="sizing-addon2">Style musical | facultatif</label>
						<input type="text" class="form-control" placeholder="stylemusical" aria-describedby="sizing-addon2" name="stylemusical">
					{{-- </div> --}}
					<br />
					<input type="submit" class="btn" value="créer l'événement">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

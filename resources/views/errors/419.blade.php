@extends('errors.layout')

@section('title', 'Page Expired')

@section('message')
    Connection expirée
    <br/><br/>
    Vous allez être redirigé.e .
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/419.js') }}"></script>
@endsection

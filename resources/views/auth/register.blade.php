@extends('site.site-layout')

@section('title', 'Registrieren')

@section('default-content')

<h1>Registrieren</h1>

<form method="POST" action="./register">
    {!! csrf_field() !!}
	
    <div class="form-group">
		<label for="tbFirstname">Vorname</label>
		<input type="text" class="form-control" name="tbFirstname" id="tbFirstname" placeholder="{{ old('tbFirstname') }}">
	</div>
	
	<div class="form-group">
		<label for="tbLastname">Nachname</label>
		<input type="text" class="form-control" name="tbLastname" id="tbLastname" placeholder="{{ old('tbLastname') }}">
	</div>

    <div class="form-group">
		<label for="tbEmail">Emailadresse</label>
		<input type="email" class="form-control" name="tbEmail" id="tbEmail" placeholder="{{ old('tbEmail') }}">
	</div>
	
	<div class="form-group">
		<label for="tbBirthdate">Geburtsdatum</label>
		<input type="date" class="form-control" name="tbBirthdate" id="tbBirthdate" placeholder="{{ old('tbBirthdate') }}">
	</div>

	<div class="form-group">
		<label for="tbPassword">Password</label>
		<input type="password" class="form-control" name="tbPassword" id="tbPassword" placeholder="Password">
	</div>

	<div class="form-group">
		<label for="tbPasswordConfirmation">Bestätige Passwort</label>
		<input type="password" class="form-control" name="tbPassword_confirmation" id="tbPassword_confirmation" placeholder="Password">
	</div>

    <button type="submit" class="btn btn-success">Registrieren</button>
	<button type="cancel" class="btn btn-danger">Abbrechen</button>
</form>
@stop
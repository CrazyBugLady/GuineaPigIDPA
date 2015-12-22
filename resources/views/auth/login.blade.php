@extends('site.site-layout')

@section('title', 'Login')

@section('default-content')

<h1>Login</h1>

<form method="POST" action="./login">
    {!! csrf_field() !!}
	
	 <input type="hidden" name="_token" value="{!! csrf_token() !!}">

    <div class="form-group">
		<label for="tbEmail">Emailadresse</label>
		<input type="email" class="form-control" name="tbEmail" id="tbEmail" placeholder="{{ old('tbEmail') }}">
	</div>

    <div class="form-group">
		<label for="tbPassword">Password</label>
		<input type="password" class="form-control" name="tbPassword" id="tbPassword" placeholder="Password">
	</div>

	<hr>
		<div class="row">
			<div class="col-md-6" style="float:right">
				<button type="submit" class="btn btn-success btn-lg btn-block">Einloggen</button>		
			</div>
		</div>
	<hr>
</form>

@stop
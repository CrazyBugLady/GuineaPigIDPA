@extends('site.site-layout')

@section('title', 'Zuchtübersicht - neue Zucht')

@section('default-content')
		
		<h1>Zuchtprofil</h1>
		
		<h2>Optionen</h2>
		
		
		<div class="row">
			<div class="form-group">
				<div class="col-sm-6">
					<a href="{{ route('create-guineapig') }}" id="createGuineaPig" class="btn btn-primary btn-lg btn-block">Neues Meerschweinchen erstellen</a>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('create-litter') }}" id="createLitter" class="btn btn-primary btn-lg btn-block">Neuen Wurf erstellen</a>
				</div>
			</div>
		</div>  
		
		<form role="form" method="post" action="{{ route('create-breeding') }}">
		{!! csrf_field() !!}
		<div class="row">
			<div class="form-group">
				<label for="tbName" class="col-sm-3 control-label">Name der Zucht</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbName" id="tbName" placeholder="Name"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="tbKuerzel" class="col-sm-3 control-label">Zuchtkürzel Standard<span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbKuerzel" id="tbKuerzel" placeholder="Zuchtkürzel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="txtDescription" class="col-sm-3 control-label">Beschreibung <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9">
						<textarea class="form-control" id="txtDescription" name="txtDescription">
							
						</textarea>
					</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="form-group">
				<div class="col-sm-6">
					<input type="submit" id="createBreeding" class="btn btn-success btn-lg btn-block" value="Speichern">
				</div>
				<div class="col-sm-6">
					<input type="reset" id="cancelCreate" class="btn btn-danger btn-lg btn-block" value="Abbrechen">
				</div>
			</div>
		</div>
		
		</form>
@stop
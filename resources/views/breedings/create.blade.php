@extends('site.site-layout')

@section('title', 'Zuchtübersicht - neue Zucht')

@section('default-content')
		
	<a href="{{ route('breeding-overview') }}" class="btn btn-success">Zur Zuchtenübersicht</a>
					
	<h1>Neue Zucht anlegen</h1>		
	<h2>Allgemeines</h2>
	
	
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
						<label for="tbKuerzel" class="col-sm-3 control-label">Zuchtkürzel Standard <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Zuchtkürzel" data-content="Meist für Zucht spezifisches, einzigartiges Kürzel zur Kennzeichnung eines Zuchttieres."></span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="tbKuerzel" id="tbKuerzel" placeholder="Zuchtkürzel"/>
							</div>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group">
						<label for="txtDescription" class="col-sm-3 control-label">Beschreibung</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="txtDescription" name="txtDescription">
								
							</textarea>
						</div>
					</div>
				</div>
				
				<hr>
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
			<hr>
			</form>
@stop
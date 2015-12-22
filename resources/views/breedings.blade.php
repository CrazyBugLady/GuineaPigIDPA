@extends('site.site-layout')

@section('title', 'Zuchten Übersicht')

@section('default-content')

<h1>Zuchtenübersicht</h1>  
	  
	<div class="row ">
		
		<div class="form-group">
			<div class="col-sm-12">
			<h2>Optionen</h2>
			
				<a href="{{ route('create-breeding') }}" id="createBreeding" class="btn btn-primary btn-lg btn-block">Neue Zucht erstellen</a>
			</div>
		</div>
	</div>  
	  
	<div id="row">
		<div id="col-md-12">	
			<h2>Zuchten</h2>
			<table class="table table-responsive">
				<tr>
					<th>Zuchtname</th>
					<th>Zuchtkürzel (Standard)</th>
					<th>Anzahl Meerschweinchen</th>
					<th>Beschreibung</th>
					<th>Optionen</th>
				</tr>
				@if(count($breedings) === 0)
					<tr>
						<td colspan="5">Keine Zucht erstellt</td>
					</tr>
				@else
					 @foreach ($breedings as $breeding)
					 <tr>
						<td>{{{ $breeding->Name}}}</td>
						<td>{{{ $breeding->BreedingAbbrDef}}}</td>
						<td>{{{ count($breeding->guineapigs(-1)) }}}</td>
						<td>{{{ $breeding->Description }}}</td>
						<td><a href="{{ route('guineapigs-overview') }}/{{{ $breeding->ID }}}">Zuchtüberblick</a></td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
	</div>
@stop
@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht')

@section('default-content')
<h1>Meerschweinchen</h1>  
	  
	<div class="row">
			<div class="form-group">
				<div class="col-sm-6">
					<a href="{{ route('create-guineapig') }}/{{{ $id_breeding }}}" id="createGuineaPig" class="btn btn-primary btn-lg btn-block">Neues Meerschweinchen erstellen</a>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('create-litter') }}/{{{ $id_breeding }}}" id="createLitter" class="btn btn-primary btn-lg btn-block">Neuen Wurf erstellen</a>
				</div>
			</div>
	</div>  
	  
	<div id="row">
		<div id="col-md-12">	
		
		
			<h2>Weibchen</h2>
				
			<table class="table table-striped">
				<tr>
					<th>Bild</th>
					<th>Name</th>
					<th>Alter</th>
					<th>Status</th>
					<th>mehr Informationen</th>
				</tr>
				@if(count($weibchen) === 0)
					<tr>
						<td colspan="5">Keine Weibchen eingetragen</td>
					</tr>
				@else
					 @foreach ($weibchen as $wGP)
					 <tr>
						<td>-- kein Bild vorhanden --</td>
						<td>{{{ $wGP->breedingAbbr}}} {{{ $wGP->Name }}}</td>
						<td>{{{ $wGP->BirthDate }}}</td>
						<td>trächtig</td>
						<td><a href="{{route('profile-guineapig')}}">...</a></td>
					</tr>
					@endforeach
				@endif
			</table>
			
			<h2>Böcke & Kastraten</h2>
				
			<table class="table table-striped">
				<tr>
					<tr>
					<th>Bild</th>
					<th>Name</th>
					<th>Alter</th>
					<th>Status</th>
					<th>mehr Informationen</th>
				</tr>
				@if(count($maennchen) === 0)
					<tr>
						<td colspan="5">Keine Böcke oder Kastraten eingetragen</td>
					</tr>
				@else
					 @foreach ($maennchen as $mGP)
					 <tr>
						<td>-- kein Bild vorhanden --</td>
						<td>{{{ $mGP->breedingAbbr }}} {{{ $mGP->Name }}}</td>
						<td>{{{ $mGP->BirthDate }}}</td>
						<td>trächtig</td>
						<td><a href="#">...</a></td>
					</tr>
					@endforeach
				@endif
			</table>
		
		</div>
	</div>
@stop
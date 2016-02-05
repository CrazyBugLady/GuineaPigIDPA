@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht')

@section('default-content')
<a href="{{ route('breeding-overview') }}" class="btn btn-success">Zur Zuchtenübersicht zurückkehren</a>

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
					<th width="40%">Bild</th>
					<th width="30%">Name</th>
					<th>mehr Informationen</th>
				</tr>
				@if(count($weibchen) === 0)
					<tr>
						<td colspan="5">Keine Weibchen eingetragen</td>
					</tr>
				@else
					 @foreach ($weibchen as $wGP)
					 <tr>
						<td><img class="img img-thumbnail" src="../../public/images/guineapig_images/{{{ $wGP->Image }}}"></td>
						<td>{{{ $wGP->breedingAbbr}}} {{{ $wGP->Name }}}</td>
						<td><a class="btn btn-primary" href="{{route('profile-guineapig')}}/{{{$wGP->ID}}}">zum Profil</a></td>
					</tr>
					@endforeach
				@endif
			</table>
			
			<h2>Böcke & Kastraten</h2>
				
			<table class="table table-striped">
				<tr>
					<th width="40%">Bild</th>
					<th width="30%">Name</th>
					<th>mehr Informationen</th>
				</tr>
				@if(count($maennchen) === 0)
					<tr>
						<td colspan="5">Keine Böcke oder Kastraten eingetragen</td>
					</tr>
				@else
					 @foreach ($maennchen as $mGP)
					 <tr>
						<td><img class="img img-thumbnail" src="../../public/images/guineapig_images/{{{ $mGP->Image }}}"></td>
						<td>{{{ $mGP->breedingAbbr }}} {{{ $mGP->Name }}}</td>
						<td><a class="btn btn-primary" href="{{route('profile-guineapig')}}/{{{$mGP->ID}}}">zum Profil</a></td>
					</tr>
					@endforeach
				@endif
			</table>
			
			<h2>Ehemalige</h2>
			<table class="table table-striped">
				<tr>
					<th width="40%">Bild</th>
					<th width="30%">Name</th>
					<th>Sterbedatum</th>
					<th>mehr Informationen</th>
				</tr>
				@if(count($verstorbene) === 0)
					<tr>
						<td colspan="5">Keine Ehemaligen</td>
					</tr>
				@else
					 @foreach ($verstorbene as $vGP)
					 <tr>
						<td><img class="img img-thumbnail" src="../../public/images/guineapig_images/{{{ $vGP->Image }}}"></td>
						<td>{{{ $vGP->breedingAbbr }}} {{{ $vGP->Name }}}</td>
						<td>{{{ $vGP->DateOfDeath }}} </td>
						<td><a class="btn btn-primary" href="{{route('profile-guineapig')}}/{{{$vGP->ID}}}">zum Profil</a></td>
					</tr>
					@endforeach
				@endif
			</table>
		</div>
	</div>
@stop
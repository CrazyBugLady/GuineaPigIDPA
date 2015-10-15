@extends('site.site-layout')

@section('title', 'Wurf-Übersicht')

@section('default-content')
<h1>Aktuelle Würfe</h1>  
	  
	<!--<div class="row">
			<div class="form-group">
				<div class="col-sm-12">
					<a href="{{ route('create-breeding') }}" id="createBreeding" class="btn btn-primary btn-lg btn-block">Neue Zucht erstellen</a>
				</div>
			</div>
	</div>  -->
	
	@if(count($breedings) > 0)
		@foreach ($breedings as $breeding)
			<h2>{{{ $breeding->Name }}}</h2>
			
			<div id="row">
				<div id="col-md-12">	
					<table class="table table-striped">
						<tr>
							<th>Titel</th>
							<th>Startdatum</th>
							<th>frühestes Wurfdatum</th>
							<th>erwartetes Wurfdatum</th>
							<th>Muttertier</th>
							<th>Vatertier</th>
						</tr>
					@if(count($breeding->mostCurrentLitters()) == 0)
						<tr>
							<td colspan="5">Keine Würfe ausstehend</td>
						</tr>
					@else
						@foreach ($breeding->mostCurrentLitters() as $litter)
						<tr>
							<td>{{{ $litter->Title }}}</td>
							<td>{{{ $litter->startdate }}}</td>
							<td>{{{ $litter->earliestLitterdate }}}</td>
							<td>{{{ $litter->expectedLitterDate }}}</td>
							<td>{{{ $litter->MotherName() }}}</td>
							<td>{{{ $litter->FatherName() }}}</td>
						</tr>
						@endforeach
					@endif
					</table>
				</div>
			</div>
			
		@endforeach
	@else
		<h2>Noch keine Zucht!</h2>
	@endif
	
				

@stop
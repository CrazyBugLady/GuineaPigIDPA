@extends('site.site-layout')

@section('title', 'Wurf-Übersicht')

@section('default-content')
<h1>Aktuelle Würfe</h1>  
	@if($show)  
	<div class="row" id="divCreateLitter">
		<div class="col-md-12">	
		<hr>
		<h3>Junge erfassen</h3>
		<br>
		
				<form method="post" action="{{ route('litter-form') }}/{{{$idlitter}}}">
				{!! csrf_field() !!}
				<div class="row">
					<input type="hidden" name="id" id="id" value="{{{$idlitter}}}">
				
					<div class="form-group">
						<label for="tbMale" class="col-sm-3 control-label">Anzahl Männchen</span></label>
							<div class="col-sm-9">
								<input type="number" class="form-control" name="tbMale" id="tbMale" required="required"/>
							</div>
					</div>
					<div class="form-group">
						<label for="tbFemale" class="col-sm-3 control-label">Anzahl Weibchen</span></label>
							<div class="col-sm-9">
								<input type="number" class="form-control" name="tbFemale" id="tbFemale" required="required"/>
							</div>
					</div>
					<div class="form-group">
						<label for="tbDead" class="col-sm-3 control-label">Anzahl Todgeburten</span></label>
							<div class="col-sm-9">
								<input type="number" class="form-control" name="tbDead" id="tbDead" required="required"/>
							</div>
					</div>
					<div class="form-group">
						<label for="tbLitterdate" class="col-sm-3 control-label">Wurfdatum</span></label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="tbLitterdate" id="tbLitterdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd.mm.yyyy"/>
							</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-responsive" id="tblGuineaPigs">
							<thead>
								<tr>
									<th>Name</th>
									<th>Rasse</th>
									<th>Farbe</th>
									<th>Geschlecht</th>
								</tr>
							</thead>
							<tbody>
							
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<input type="submit" class="btn btn-success col-md-6" value="Speichern">
					<input type="reset"  class="btn btn-warning col-md-6" value="Abbrechen">
				</div>
			</form>
		</div>
	</div>
	@endif		
	
	@if(count($breedings) > 0)
		@foreach ($breedings as $breeding)
			<div id="row">
				<h2>{{{ $breeding->Name }}}</h2>
				
					<table class="table table-striped">
						<tr>
							<th>Titel</th>
							<th>Startdatum</th>
							<th>frühestes Wurfdatum</th>
							<th>erwartetes Wurfdatum</th>
							<th>Muttertier</th>
							<th>Optionen</th>
						</tr>
				
						@if(count($breeding->mostCurrentLitters()) > 0)
							@foreach ($breeding->mostCurrentLitters() as $litter)
								<tr>
									<td>{{{ $litter->Title }}}</td>
									<td>{{{ $litter->startdate }}}</td>
									<td>{{{ $litter->earliestLitterdate }}}</td>
									<td>{{{ $litter->expectedLitterDate }}}</td>
									<td>{{{ $litter->Name }}}</td>
									<td><a href="{{ route('litter-form') }}/{{{$litter->ID}}}" class="btn btn-success">hat geworfen</a><br>
										<a href="{{ route('litter-update') }}?newStatus=2&id={{{ $litter->ID }}}" class="btn btn-warning">hat nicht aufgenommen</a><br>
										<a href="{{ route('litter-update') }}?newStatus=1&id={{{ $litter->ID }}}"" class="btn btn-danger">Todgeburt</a></td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="6">Für diese Zucht gibt es aktuell keine Würfe.</td>
							</tr>
						@endif
					</table>
			</div>
		@endforeach
	@else
		<h2>Noch keine Zucht!</h2>
	@endif
@stop
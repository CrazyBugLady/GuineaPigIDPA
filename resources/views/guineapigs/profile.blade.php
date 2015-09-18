@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - Meerschweinchen')

@section('default-content')
		
		<h1>Meerschweinchenprofil</h1>
		
		<h2>Optionen</h2>
		<div class="row">
			<div class="form-group">
				<div class="col-sm-6">
					<a href="{{ route('create-weighing') }}/{{{ $selectedGP->ID }}}" id="createWeighing" class="btn btn-primary btn-lg btn-block">Neustes Gewicht eintragen</a>
				</div>
				<div class="col-sm-6">
					<a href="{{ route('sexe-change') }}/{{{ $selectedGP->ID }}}" id="updateGuineaPig" class="btn btn-primary btn-lg btn-block">Kastrieren lassen</a>
				</div>
			</div>
		</div>
		
		<h2>Allgemeines</h2>
		
		<div class="row">
			<div class="col-md-6">
				Name
			</div>
			<div class="col-md-6">
				{{{$selectedGP->breedingabbr}}} {{{$selectedGP->Name}}}
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				Geburtsdatum
			</div>
			<div class="col-md-6">
				{{{$selectedGP->BirthDate}}}
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				Geschlecht
			</div>
			<div class="col-md-6">
				@if($selectedGP->Sexe == 0)
					Bock
				@elseif($selectedGP->Sexe == 1)
					Weibchen
				@else
					Kastrat
				@endif
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				Status
			</div>
			<div class="col-md-6">
				@if($selectedGP->isInCalf())
					trächtig
				@else
					bereit zur Zucht
				@endif
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				aktuelles Gewicht
			</div>
			<div class="col-md-6">
				{{$selectedGP->currentWeight()}} kg
			</div>
		</div>
		
		<hr>
		
		<h2>Eigenschaften</h2>
		
		<div class="row">
			<div class="col-md-6">
				Rasse
			</div>
			<div class="col-md-6">
				{{{$selectedGP->Race}}}
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				Farbe
			</div>
			<div class="col-md-6">
				{{{$selectedGP->Color}}}
			</div>
		</div>
		
		<hr>
		
		<h2>Wiegungen</h2>
		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-responsive" id="tblWeighings">
					<thead>
						<tr>
							<th>Datum</th>
							<th>Gewicht in kg</th>
						</tr>
					</thead>
					<tbody>
					@if(count($selectedGP->weighings) > 0)
						@foreach($selectedGP->weighings as $weighing)
						<tr>
							<td><input type="date" class="form-control" name="date[]" id="date" placeholder="Wiegedatum Meerschweinchen" value="{{{$weighing->DateOfWeighing}}}"/></td>
							<td><input type="number" class="form-control" name="weight[]" id="weight" placeholder="Gewicht Meerschweinchen" value="{{{$weighing->Weight}}}"/> kg</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="2">Noch nie gewogen</td>
						</tr>
						
					@endif
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td class="text-right">
								<a href="#" id="btnAddWeighing" class="btn btn-warning">Hinzufügen</a>
								<a href="{{ route('create-weighing') }}/{{{ $selectedGP->ID }}}" id="saveWeighings" class="btn btn-success">Speichern</a>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		
@stop
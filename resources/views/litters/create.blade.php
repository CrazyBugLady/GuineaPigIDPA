@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neuer Wurf')

@section('default-content')
		
		
		<h1>Neuen Wurf generieren</h1>
		
		<h2>Zusammenstellung</h2>
		
		<form role="form" action="{{ route('create-litter') }}" method="post">
			<div class="row">
				<div class="col-md-12">
						<label for="ddlMaennchen" class="col-sm-3 control-label">Männchen</span></label>
							<div class="col-sm-3">
								<select class="form-control" id="ddlMaennchen" name="ddlMaennchen">
									@if (count($maennchen) === 0)
										<option value="-1">Keine zuchtfähigen Männchen angelegt</option>
									@else
										@foreach ($maennchen as $mGP)
											<option value="{{{ $mGP->ID }}}">{{{ $mGP->breedingAbbr }}} {{{ $mGP->Name }}}</option>
										@endforeach
									@endif
								</select>
							</div>

							<label for="ddlWeibchen" class="col-sm-3 control-label">Weibchen</span></label>
							<div class="col-sm-3">
								<select class="form-control" id="ddlWeibchen" name="ddlWeibchen">
									@if (count($weibchen) === 0)
										<option value="-1">Keine Weibchen angelegt</option>
									@else
										@foreach ($weibchen as $wGP)
											<option value="{{{ $wGP->ID }}}">{{{ $wGP->breedingAbbr }}} {{{ $wGP->Name }}}</option>
										@endforeach
									@endif
								</select>
							</div>
					</div>	
				</div>
				
				<hr>
				
				<div class="row">
					<div class="col-md-12">	
						<div class="col-md-6 text-center">
							<span id="spRaceM">Rasse</span><br>
							<span id="spColorM">Farbe</span><br>
							<span id="spAgeM">Alter</span>
						</div>
						<div class="col-md-6 text-center">
							<span id="spRaceW">Rasse</span><br>
							<span id="spColorW">Farbe</span><br>
							<span id="spAgeW">Alter</span>
						</div>
					</div>
				</div>
				
				<hr>
				
				<div class="row">
					<div class="form-group">
						<div class="col-sm-6">
							<button id="btnCreateWurfTemp" class="btn btn-warning btn-lg btn-block">Wurf Vorschau</button>
						</div>
						<div class="col-sm-6">
							<button id="btnCreateWurf" class="btn btn-success btn-lg btn-block">Verpaarung erstellen</button>
						</div>
					</div>
				</div>

				<div class="row" id="divCreate">
					<div class="col-md-12">	
					<hr>
					<h3>Wurf erstellen</h3>
					<br>
						
							{!! csrf_field() !!}
							<div class="row">
								<div class="form-group">
									<label for="tbTitle" class="col-sm-3 control-label">Titel</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="tbTitle" id="tbTitle" placeholder="Titel des Wurfs"/>
										</div>
								</div>
								<div class="form-group">
									<label for="tbStartdate" class="col-sm-3 control-label">Startdatum</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" name="tbStartdate" id="tbStartdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd.mm.yyyy"/>
										</div>
								</div>
								<div class="form-group">
									<label for="tbEarliestLitterdate" class="col-sm-3 control-label">Frühstes Wurfdatum</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" name="tbEarliestLitterdate" id="tbEarliestLitterdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd.mm.yyyy" readonly />
										</div>
								</div>
								<div class="form-group">
									<label for="tbExpectedLitterdate" class="col-sm-3 control-label">Erwartetes Wurfdatum</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" name="tbExpectedLitterdate" id="tbExpectedLitterdate" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="dd.mm.yyyy" readonly />
										</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12 text-right">
										<input type="submit" class="btn btn-success btn-lg btn-block" name="btnCreateFinish" id="btnCreateFinish" value="Verpaarung bestätigen">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-md-12">	
					<hr>
					<h3>Meldungen</h3>
					<br>
						<div class="alert alert-danger" id="warningLetalFactor" role="alert">Diese beiden dürfen nicht miteinander verpaart werden! Letalfaktor - Gefahr.</div>
						<!--<div class="alert alert-warning" role="alert">Bitte Inzuchtfaktor beachten!</div>
						<div class="alert alert-success" role="alert">Geplanter Wurf wurde erfolgreich gespeichert.</div>-->
					</div>
				</div>
			
		
		
		<hr>
		
		<h2 id="hLitter">Erwarteter Wurf</h2>
		
		<div class="row">
			<div class="col-md-12">	
				<table class="table table-striped" id="tblLitterColor">
					<thead>
						<th>Wahrscheinlichkeit</th>
						<th width="50%">Farbe</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">	
				<table class="table table-striped" id="tblLitterRace">
					<thead>
						<th>Wahrscheinlichkeit</th>
						<th width="50%">Rasse</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<h2 id="hLitterParams">Wahrscheinlichste Wurfparameter</h2>
		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" id="tblLitterParams">
					<thead>
						<th>Anzahl Junge</th>
						<th>kürzeste Tragzeit</th>
						<th>wahrscheinlichste Tragzeit</th>
						<th>Geschlechterverteilung</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
@stop
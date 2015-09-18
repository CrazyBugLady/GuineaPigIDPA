@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neuer Wurf')

@section('default-content')
		
		
		<h1>Neuen Wurf generieren</h1>
		
		<h2>Zusammenstellung</h2>
		
		<form role="form">
			<div class="row">
				<div class="col-md-12">
						<label for="ddlMaennchen" class="col-sm-3 control-label">Männchen</span></label>
							<div class="col-sm-3">
								<select class="form-control" id="ddlMaennchen">
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
								<select class="form-control" id="ddlWeibchen">
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
							<span id="spRaceM">Rasse</span>
							<span id="spColorM">Farbe</span>
							<span id="spAgeM">Alter</span>
						</div>
						<div class="col-md-6 text-center">
							<span id="spRaceW">Rasse</span>
							<span id="spColorW">Farbe</span>
							<span id="spAgeW">Alter</span>
						</div>
					</div>
				</div>
				
				<hr>
				
				<div class="row">
					<div class="form-group">
						<div class="col-sm-4">
							<input type="submit" id="createWurf" class="btn btn-success btn-lg btn-block" value="Wurf speichern">
						</div>
						<div class="col-sm-4">
							<button id="btnCreateWurfTemp" class="btn btn-warning btn-lg btn-block">Wurf Vorschau</button>
						</div>
						<div class="col-sm-4">
							<input type="reset" id="cancelCreate" class="btn btn-danger btn-lg btn-block" value="Abbrechen">
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">	
					<h3>Meldungen</h3>
					<br>
						<div class="alert alert-danger" id="warningLetalFactor" role="alert">Diese beiden dürfen nicht miteinander verpaart werden! Letalfaktor - Gefahr.</div>
						<!--<div class="alert alert-warning" role="alert">Bitte Inzuchtfaktor beachten!</div>
						<div class="alert alert-success" role="alert">Geplanter Wurf wurde erfolgreich gespeichert.</div>-->
					</div>
				</div>
			
		</form>
		
		<hr>
		
		<h2>Erwarteter Wurf</h2>
		
		<div class="row">
			<div class="col-md-12">	
				<table class="table table-striped" id="tblLitter">
					<thead>
						<th>Junges</th>
						<th>Farbe</th>
						<th>Rasse</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<!---
		<h3>Wahrscheinlichkeiten <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Deckungsfaktor" data-content="Ist das Meerschweinchen gescheckt? Zeigt sich nur eine der beiden Farbreihen?"></span></h3>
		<div class="row">
			<div class="col-md-12">	
				<table class="table table-striped">
					<tr>
						<th colspan="2">Wahrscheinlichkeit</th>
						<th>Wurfgrösse</th>
					</tr>
					<tr>
						<td colspan="2">20%</td>
						<td>2</td>
					</tr>
					<tr>
						<th>Wahrscheinlichkeit</th>
						<th>Zuchtcode</th>
						<th>Bezeichnung</th>
					<tr>
					<tr>
						<td>25%</td>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
					</tr>
					<tr>
						<td>25%</td>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
					</tr>
					<tr>
						<td>25%</td>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
					</tr>
					<tr>
						<td>25%</td>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
					</tr>
				</table>
			</div>
		</div>
		
		<h3>Wahrscheinlichster Wurf</h3>
		<div class="row">
			<div class="col-md-12">	
				<table class="table table-striped">
					<tr>
						<th>Junges #1</th>
						<th>Junges #2</th>
						<th>Junges #3</th>
					</tr>
					<tr>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
						<td>BB CC EE PP ss</td>
					</tr>
				</table>
			</div>
		</div>--->
@stop
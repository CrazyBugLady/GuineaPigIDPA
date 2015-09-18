@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neues Meerschweinchen')

@section('default-content')
		
		<h1>Neues Meerschweinchen generieren</h1>
		
		<h2>Allgemeines</h2>
		
		
		<form role="form" method="post" action="{{ route('create-guineapig') }}/{{{ $selected_breeding->ID }}}">
		{!! csrf_field() !!}
		<div class="row">
			<div class="form-group">
				<label for="tbName" class="col-sm-3 control-label">Name</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbName" id="tbName" placeholder="Name Meerschweinchen"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label">Zucht</span></label>
				<div class="col-sm-9 text-center">
					<select class="form-control" id="ddlIdBreeding" name="ddlIdBreeding">
					@if (count($breedings) === 0)
						<option value="-1">Keine Zucht angelegt</option>
					@else
						@foreach ($breedings as $breeding)
							@if($selected_breeding->ID == $breeding->ID) 
								<option value="{{{ $breeding->ID }}}" selected>{{{ $breeding->Name }}}</option>
							@else
								<option value="{{{ $breeding->ID }}}">{{{ $breeding->Name }}}</option>
							@endif
						@endforeach
					@endif
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="tbKuerzel" class="col-sm-3 control-label">Zuchtkürzel <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbKuerzel" id="tbKuerzel" placeholder="Zuchtkürzel"/>
					</div>
			</div>
		</div>
		
		<hr>
		
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label">Geschlecht</span></label>
				<div class="col-sm-9 text-center">
					<label class="radio-inline">
						<input type="radio" name="rgeschlecht" id="bock" value="0"> Bock
					</label>
					<label class="radio-inline">
						<input type="radio" name="rgeschlecht" id="weibchen" value="1"> Weibchen
					</label>
					<label class="radio-inline">
						<input type="radio" name="rgeschlecht" id="kastrat" value="2"> Kastrat
					</label>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="tbGeburtsdatum" class="col-sm-3 control-label">Geburtsdatum</span></label>
					<div class="col-sm-9">
						<input type="date" class="form-control" name="tbAlter" id="tbAlter" placeholder="dd.mm.yyyy" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}"/>
					</div>
			</div>
		</div>
		
		<h2>Rasse</h2>
		
		<div class="row">
			<div class="form-group">
				<label for="tbRasseformel" class="col-sm-3 control-label">Rasseformel <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="tbRasseformel" name="tbRasseformel" placeholder="Rasseformel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbKurzhaar" class="col-sm-3 control-label">Kurzhaar <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-3">
						<input type="radio" class="form-control" name="optionHaar" id="cbKurzhaar" value="kurzhaar" checked>
					</div>
					<div class="col-sm-6">
						<select class="form-control">
							<option>Am. Crested</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbLanghaar" class="col-sm-3 control-label">Langhaar <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="radio" class="form-control" name="optionHaar" id="cbLanghaar" value="langhaar" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control">
						<option>Texel</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>
		</div>
						
		<div class="row">
			<div class="form-group">
				<label for="cbHaarlos" class="col-sm-3 control-label">Haarlos <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="checkbox" class="form-control" id="cbHaarlos" value="haarlos" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlHaarlos">
						<option>Skinny</option>
						<option>Baldwin</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label">Satin <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-9 text-center">
					<label class="radio-inline">
						<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> nein
					</label>
					<label class="radio-inline">
						<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Satin
					</label>
					<label class="radio-inline">
						<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Satin-Träger
					</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label">Träger <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-9">
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox1" value="option1"> Rex-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox2" value="option2"> "US-Teddy"-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox3" value="option3"> "CH-Teddy" - Träger
						</label>
					</div>
				</div>
			</div>
		</div>	
			
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox1" value="option1"> Texel-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox2" value="option2"> Merino-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox3" value="option3"> Alpaka-Träger
						</label>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox1" value="option1"> Glatthaar-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox2" value="option2"> Skinny-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="inlineCheckbox3" value="option3"> Baldwin-Träger
						</label>
					</div>
				</div>
			</div>
		</div>
	  
	    <h2>Farbe</h2>
				
		<div class="row">
			<div class="form-group">
				<label for="tbFarbformel" class="col-sm-3 control-label">Farbformel <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbFarbformel" id="tbFarbformel" placeholder="Farbformel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbAgouti" class="col-sm-3 control-label">Agouti <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Deckungsfaktor" data-content=""></span></label>
				<div class="col-sm-3">
					<input type="checkbox" class="form-control" id="cbAgouti" value="agouti" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlAgouti">
						<option value="A">agouti/argente</option>
						<option value="ar">solid agouti</option>
						<option value="at">lohfarben</option>
					</select>
				</div>
			</div>
		</div>		
				
		<div class="row">
			<div class="form-group">
				<label for="ddlRotreihe" class="col-sm-3 control-label">Rotreihe <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9" id="ddlRotreihe">
						<select class="form-control">
							<option>rot/gold</option>
							<option>buff</option>
							<option>safran</option>
							<option>creme</option>
							<option>weiss</option>
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="ddlSchwarzreihe" class="col-sm-3 control-label">Schwarzreihe <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-9" id="ddlSchwarzreihe">
						<select class="form-control">
							<option>beige</option>
							<option>lilac</option>
							<option>coffee</option>
							<option>slateblue</option>
							<option value="bb">schoko</option>
							<option value="BB CC">schwarz</option>
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="ddlScheckung" class="col-sm-3 control-label">Deckungsfaktor <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Deckungsfaktor" data-content="Ist das Meerschweinchen gescheckt? Zeigt sich nur eine der beiden Farbreihen?"></span></label>
					<div class="col-sm-9">
						<select class="form-control">
							<option value="ep">gescheckt</option>
							<option value="E">keine Rotreihe</option>
							<option value="ee">keine Schwarzreihe</option>
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="ddlScheckung" class="col-sm-3 control-label">Schimmel / Dalmatiner <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Deckungsfaktor" data-content="Ist das Meerschweinchen gescheckt? Zeigt sich nur eine der beiden Farbreihen?"></span></label>
					<div class="col-sm-9">
						<input type="checkbox" class="form-control" id="cbDalmatinerSchimmel" value="Rnrn" checked>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbWeissscheckung" class="col-sm-3 control-label">Weissscheckung <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Deckungsfaktor" data-content="Ist das Meerschweinchen gescheckt? Zeigt sich nur eine der beiden Farbreihen?"></span></label>
					<div class="col-sm-9">
						<input type="checkbox" class="form-control" id="cbWeissscheckung" value="ss" checked>
					</div>
			</div>
		</div>
		
		
		
		<div class="row">
			<div class="form-group">
				<div class="col-sm-6">
					<input type="submit" id="createGuineaPig" class="btn btn-success btn-lg btn-block" value="Speichern">
				</div>
				<div class="col-sm-6">
					<input type="reset" id="cancelCreate" class="btn btn-danger btn-lg btn-block" value="Abbrechen">
				</div>
			</div>
		</div>
		
		</form>
@stop
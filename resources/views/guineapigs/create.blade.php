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
						<select class="form-control" id="ddlShortHair">
							<option>Am. Crested</option>
							<option>Glatthaar</option>
							<option>Rosetten</option>
							<option>Rex</option>
							<option>US-Teddy</option>
							<option>CH-Teddy</option>
							<option>Curly</option>
							<option>Angora</option>
							<option>Sheba Mini Yak</option>
							<option>Minipli</option>
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
					<select class="form-control" id="ddLongHair">
						<option>Texel</option>
						<option>Sheltie</option>
						<option>Coronet</option>
						<option>Peruaner</option>
						<option>Merino</option>
						<option>Alpaka</option>
						<option>Lunkarya</option>
						<option>Merino</option>
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
						<option value="sksk">Skinny</option>
						<option value="bdbd">Baldwin</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label">Satin <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-9 text-center">
					<label class="radio-inline">
						<input type="radio" name="rdSatin" id="optionSatin1" value="optionSatinNo"> nein
					</label>
					<label class="radio-inline">
						<input type="radio" name="rdSatin" id="optionSatin2" value="optionSatinYes"> Satin
					</label>
					<label class="radio-inline">
						<input type="radio" name="rdSatin" id="optionSatin3" value="optionSatinMaybeLater"> Satin-Träger
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
							<input type="checkbox" id="cbskTraeger" value="skTraeger"> Skinny-Träger
						</label>
					</div>
					<div class="col-sm-3">
						<label class="checkbox-inline">
							<input type="checkbox" id="cbBdTraeger" value="bdTraeger"> Baldwin-Träger
						</label>
					</div>
				</div>
			</div>
		</div>
	  
	    <h2>Farbe</h2>
				
		<div class="row">
			<div class="form-group">
				<label for="tbFarbformel" class="col-sm-3 control-label">Farbformel <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Farbformel" data-content="In der Zucht verwendete Formel zur Darstellung der Allelzusammenstellung einer Farbgattung."></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbFarbformel" id="tbFarbformel" placeholder="Farbformel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbagouti" class="col-sm-3 control-label">Agouti/Argente <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-3">
						<input type="radio" class="form-control" name="Farbgruppe" id="cbagouti" value="agouti" checked>
					</div>
					<div class="col-sm-6">
						<select class="form-control" id="ddlAgouti">
							<option>Am. Crested</option>
							<option>Glatthaar</option>
							<option>Rosetten</option>
							<option>Rex</option>
							<option>US-Teddy</option>
							<option>CH-Teddy</option>
							<option>Curly</option>
							<option>Angora</option>
							<option>Sheba Mini Yak</option>
							<option>Minipli</option>
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbSolid" class="col-sm-3 control-label">Solid <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="radio" class="form-control" name="Farbgruppe" id="cbSolid" value="solid" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlSolid">
						<option>Texel</option>
						<option>Sheltie</option>
						<option>Coronet</option>
						<option>Peruaner</option>
						<option>Merino</option>
						<option>Alpaka</option>
						<option>Lunkarya</option>
						<option>Merino</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbzeichnungen" class="col-sm-3 control-label">Zeichnungen <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="radio" class="form-control" name="Farbgruppe" id="cbzeichnungen" value="zeichnungen" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlZeichnung">
						<option>Texel</option>
						<option>Sheltie</option>
						<option>Coronet</option>
						<option>Peruaner</option>
						<option>Merino</option>
						<option>Alpaka</option>
						<option>Lunkarya</option>
						<option>Merino</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbEinfarbig" class="col-sm-3 control-label">Einfarbig <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="radio" class="form-control" name="Farbgruppe" id="cbEinfarbig" value="einfarbig" checked>
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlEinfarbig">
						<option>Texel</option>
						<option>Sheltie</option>
						<option>Coronet</option>
						<option>Peruaner</option>
						<option>Merino</option>
						<option>Alpaka</option>
						<option>Lunkarya</option>
						<option>Merino</option>
					</select>
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
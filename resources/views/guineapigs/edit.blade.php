@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neues Meerschweinchen')

@section('default-content')
		
	<a href="{{ route('profile-guineapig') }}/{{{ $selectedgp->ID }}}" class="btn btn-success">Zum Meerschweinchenprofil zurückkehren</a>
				
	<h1>Meerschweinchen überarbeiten</h1>
		
		
	<form role="form" method="post" action="{{ route('guineapig-edit') }}/{{{ $selectedgp->ID }}}">
		{!! csrf_field() !!}
		
		<h2>Rasse</h2>
		
		<div class="row">
			<div class="form-group">
				<label for="tbRasseformel" class="col-sm-3 control-label">Rasseformel <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Rasseformel oder Fellstrukturformel" data-content="In der Zucht verwendete Formel zur Darstellung der Allelzusammenstellung einer Rasse."></span></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="tbRasseformel" value="{{{$selectedgp->Race}}}" name="tbRasseformel" placeholder="Rasseformel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbShorthair" class="col-sm-3 control-label">Kurzhaar <span class="glyphicon glyphicon-question-sign"></span></label>
					<div class="col-sm-3">
						<input type="radio" class="form-control" name="optionHaar" id="cbShorthair" value="kurzhaar">
					</div>
					<div class="col-sm-6">
						<select class="form-control" id="ddlShortHair">
						@foreach($short_hair as $short)
							<option value="{{{$short->Code}}}">{{{$short->Name}}}</option>
						@endforeach
						</select>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<label for="cbLonghair" class="col-sm-3 control-label">Langhaar <span class="glyphicon glyphicon-question-sign"></span></label>
				<div class="col-sm-3">
					<input type="radio" class="form-control" name="optionHaar" id="cbLonghair" value="langhaar">
				</div>
				<div class="col-sm-6">
					<select class="form-control" id="ddlLongHair">
					@foreach($long_hair as $long)
						<option value="{{{$long->Code}}}">{{{$long->Name}}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
		
	    <h2>Farbe</h2>
				
		<div class="row">
			<div class="form-group">
				<label for="tbFarbformel" class="col-sm-3 control-label">Farbformel <span class="glyphicon glyphicon-question-sign" data-trigger="hover" data-placement="top" data-toggle="popover" title="Farbformel" data-content="In der Zucht verwendete Formel zur Darstellung der Allelzusammenstellung einer Farbgattung."></span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="tbFarbformel" id="tbFarbformel" value="{{{$selectedgp->Color}}}" placeholder="Farbformel"/>
					</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				
				<div class="col-sm-3">
					<label class="radio-inline">
						<input type="radio" name="Farbgruppe" id="rdAgouti" value="agouti"> Agouti
					</label>
				</div>
				<div class="col-sm-9">
					<select class="form-control" id="ddlAgouti">
						@foreach($agouti as $a)
							<option value="{{{$a->Code}}}">{{{$a->Name}}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>		
		
		<div class="row">
			<div class="form-group">
				
				<div class="col-sm-3">
					<label class="radio-inline">
						<input type="radio" name="Farbgruppe" id="rdSolidagouti" value="solidagouti"> Solidagouti
					</label>
				</div>
				<div class="col-sm-9">
					<select class="form-control" id="ddlSolidagouti">
						@foreach($solidagouti as $sa)
							<option value="{{{$sa->Code}}}">{{{$sa->Name}}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>	
						
		<div class="row">
			<div class="form-group">
				<div class="col-sm-3">
					<label class="radio-inline">
						<input type="radio" name="Farbgruppe" id="rdEinfarbig" value="einfarbig"> Einfarbig
					</label>
				</div>
				<div class="col-sm-9">
					<select class="form-control" id="ddlEinfarbig">
						@foreach($unicolor as $uc)
							<option value="{{{$uc->Code}}}">{{{$uc->Name}}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="form-group">
				<div class="col-sm-3">
					<label class="radio-inline">
						<input type="radio" name="Farbgruppe" id="rdZeichnungen" value="zeichnungen"> Zeichnungen
					</label>
				</div>
				<div class="col-sm-9">
					<select class="form-control" id="ddlZeichnungen">
						@foreach($multicolored as $mc)
								<option value="{{{$mc->Code}}}">{{{$mc->Name}}}</option>
							@endforeach
					</select>
				</div>
			</div>
		</div>	
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<input type="submit" id="updateGuineapig" class="btn btn-success btn-lg btn-block" value="Speichern">
			</div>
			<div class="col-sm-6">
				<input type="reset" id="cancelUpdate" class="btn btn-danger btn-lg btn-block" value="Abbrechen">
			</div>
		</div>
		
	</form>
	
	<hr>
@stop
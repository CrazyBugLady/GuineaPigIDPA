@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - Meerschweinchen')

@section('default-content')
		
		<a href="{{ route('guineapigs-overview') }}/{{{ $selectedGP->id_breeding }}}" class="btn btn-success">Zur Zucht zurückkehren</a>
		
		
		<h1>Meerschweinchenprofil</h1>
		
		@if($selectedGP->DateOfDeath != null)
			<h3><i>Meerschweinchen gestorben am <u>{{{$selectedGP->DateOfDeath}}}</u></i></h3>
		@endif
		
		<h2>Optionen</h2>
		<div class="row">
		@if($selectedGP->DateOfDeath == null)
			<div class="form-group">
				<div class="col-sm-4">
					<a href="{{ route('guineapig-edit') }}/{{{ $selectedGP->ID }}}" id="updateGuineaPig" class="btn btn-primary btn-lg btn-block">Bearbeiten</a>
				</div>
				<div class="col-sm-4">
					<a href="{{ route('deathdate-guineapig') }}/{{{ $selectedGP->ID }}}" id="updateGuineaPig" class="btn btn-primary btn-lg btn-block">Verstorben</a>
				</div>
				@if($selectedGP->Sexe == 0)
				<div class="col-sm-4">
					<a href="{{ route('sexe-change') }}/{{{ $selectedGP->ID }}}" id="updateGuineaPig" class="btn btn-primary btn-lg btn-block">Kastriert</a>
				</div>
				@endif
				
			</div>
		@else
			Keine Optionen stehen zur Verfügung
		@endif
		</div>
		
		<h2>Allgemeines</h2>
		
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<td><img class="img img-thumbnail" src="../../../public/images/guineapig_images/{{{ $selectedGP->Image }}}"></td>
						
						<form action="{{ route('guineapig-image')}}/{{{$selectedGP->ID}}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
					
							<p>
								<span>Wählen Sie eine Bilddatei aus (.jpg, .jpeg, .png):</span><br> 
								<input name="imgGuineaPig" class="form-control" type="file" size="50"> 
							</p>  
							<input type="submit" class="btn btn-success" value="hochladen">
						</form>
					</div>
				</div>
			</div>
		
			<div class="col-md-4">
				<div id="row">
					<div class="col-md-12">
						Name
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						Geburtsdatum
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						Geschlecht
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						Status
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						aktuelles Gewicht
					</div>
				</div>
				</div>
			
			<div class="col-md-4">
				<div id="row">
					<div id="col-md-12">
						{{{$selectedGP->breedingabbr}}} {{{$selectedGP->Name}}}
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						{{{$selectedGP->getFormattedBirthdate()}}} ( {{{$selectedGP->getAge()}}} )
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						@if($selectedGP->Sexe == 0)
							Bock
						@elseif($selectedGP->Sexe == 1)
							Weibchen
						@else
							Kastrat
						@endif
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
					@if($selectedGP->Sexe == 1)
						@if($selectedGP->isInCalf())
							trächtig
						@else
							bereit zur Zucht
						@endif
					@else
						@if($selectedGP->Sexe == 0)
							bereit zur Zucht
						@else
							kastriert am {{{$selectedGP->DateOfCastration}}}
						@endif
					@endif
					</div>
				</div>
				<div id="row">
					<div id="col-md-12">
						{{$selectedGP->currentWeight()}} kg
					</div>
				</div>
			</div>
		</div>
		<hr>
		
		<h2>Eigenschaften</h2>
		
		<div class="row">
			<div class="col-md-6">
				Rasse
			</div>
			<div class="col-md-6">
				{{{$race}}}
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				Farbe
			</div>
			<div class="col-md-6">
				{{{$color}}}
			</div>
		</div>

		<hr>
		
		<h2>Stammbaum</h2>
		
		<table class="table table-striped">
			<tr>
				<th colspan="2">Muttertier</th>
				<th colspan="2">Vatertier</th>
			</tr>
			<tr>
				<td colspan="2">{{{ $familytree["mother"] }}}</td>
				<td colspan="2">{{{ $familytree["father"] }}}</td>
			</tr>
			<tr>
				<th>Grossmutter</th>
				<th>Grossvater</th>
				<th>Grossmutter</th>
				<th>Grossvater</th>
			</tr>
			<tr>
				<td>{{{ $familytree["grandmother_m"] }}}</td>
				<td>{{{ $familytree["grandfather_m"] }}}</td>
				<td>{{{ $familytree["grandmother_f"] }}}</td>
				<td>{{{ $familytree["grandfather_f"] }}}</td>
			</tr>
		</table>
		
		<h2>Alle Verpaarungen</h2>
		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" id="tblLitters">
					<thead>
						<tr>
							<th>Wurfname</th>
							<th>Wurfergebnis</th>
							<th>Startdatum</th>
							<th>Enddatum</th>
							@if($selectedGP->Sexe == 1)
								<th>Vatertier</th>
							@else
								<th>Muttertier</th>
							@endif
						</tr>
					</thead>
					<tbody>
					@if(count($selectedGP->childLitters) > 0)
						@foreach($selectedGP->childLitters as $litter)
						<tr>
							<td>{{{$litter->Title}}}</td>
							@if($litter->LitterStatus != 'wirkungslos' and $litter->LitterStatus != 'Todgeburt')
								<td>{{{$litter->LitterResult}}} ( {{{$litter->Litterresult}}} )</td>
							@elseif($litter->LitterStatus == 'wirkungslos')
								<td>nicht aufgenommen</td>
							@else
								<td>Todgeburt</td>
							@endif
							<td>{{{$litter->startdate}}}</td>
							<td>{{{$litter->realLitterdate}}}</td>
							@if($selectedGP->Sexe == 1)
								<td><a href="{{route('profile-guineapig')}}/{{{$litter->FatherGuineaPig()->first()->ID}}}">{{{$litter->FatherGuineaPig()->first()->Name}}}</a></td>
							@else
								<td><a href="{{route('profile-guineapig')}}/{{{$litter->MotherGuineaPig()->first()->ID}}}">{{{$litter->MotherGuineaPig()->first()->Name}}}</a></td>
							@endif
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5">Noch keinen Wurf eingetragen</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
		
		<hr>
		
		<h2>Wiegungen</h2>
		<form method="post" action="{{ route('create-weighing') }}/{{{ $selectedGP->ID }}}">
		{!! csrf_field() !!}
		
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
							<td>{{{$weighing->DateOfWeighing}}}</td>
							<td>{{{$weighing->Weight}}} kg</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="2">Noch nie gewogen</td>
						</tr>
						
					@endif
					</tbody>
					@if($selectedGP->DateOfDeath == null)
					<tfoot>
						<tr>
							<td></td>
							<td class="text-right">
								<a href="#" id="btnAddWeighing" class="btn btn-warning">Hinzufügen</a>
								<input type="submit" id="saveWeighings" class="btn btn-success" value="Speichern">
							</td>
						</tr>
					</tfoot>
					@endif
				</table>
			</div>
		</div>
		</form>
		
@stop
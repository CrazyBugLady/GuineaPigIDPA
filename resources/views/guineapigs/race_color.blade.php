@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neues Meerschweinchen')

@section('default-content')
		
		<h1>{{{ $book }}}</h1>
		
		<h2>{{{ $booktitletwo }}}</h2>
		@foreach($combinations as $combination)
		<table class="table table-striped">
			<tr>
				<th>{{{ $combination->Name}}}</th>
			</tr>
			<tr>
				<td>{{{ $combination->Description }}}</td>
			</tr>
		</table>
		@endforeach
@stop
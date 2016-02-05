@extends('site.site-layout')

@section('title', 'Meerschweinchen Übersicht - neues Meerschweinchen')

@section('default-content')
		
		<h1>{{{ $book }}}</h1>
		@foreach($combinations as $combination)
		<table class="table table-striped">
			<tr>
			@if($combination->ImageUrl != null)
				<th colspan="2">{{{ $combination->Name}}}</th>
			@else
				<th>{{{ $combination->Name}}}</th>
			@endif
				
			</tr>
			<tr>
			@if($combination->ImageUrl != null)
				<td width="40%" class="text-center"><img class="img img-thumbnail" src="../../public/images/RaceColorBook_Images/{{{$combination->ImageUrl}}}"></td>
			@endif
				<td>{{{ $combination->Description }}}<br><b>{{{$combination->Code}}}</b></td>
			</tr>
		</table>
		@endforeach
@stop
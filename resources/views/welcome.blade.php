@extends('site.site-layout')

@section('title', 'Startseite')

@section('default-content')

<h1>Herzlich Willkommen</h1>

<div class="row">
	<div class="col-md-12">
		<p>Wir freuen uns sehr, dass Sie unsere Seite aufgerufen haben. Diese Seite ist eine Onlinezuchtverwaltung, die dazu dient, Ihre Meerschweinchenzucht sinnvoll zu administrieren und darüber
		hinaus, überall voll zugänglich zu haben. Sie soll die Verwaltung Ihrer Meerschweinchen, geplanten Verpaarungen und Würfe erleichtern und darüber hinaus eine einfachere Verwaltung im Allgemeinen möglich machen.</p>
		
		<p>Wir, also die Erschaffer dieser Seite, sind kurz gesagt zwei Informatiklernende, die diese Seite als Abschlussarbeit der Berufsmatura umgesetzt haben. 
		Unsere Lehre werden wir im Jahr 2016 im Sommer mit der Berufsmatura abschliessen.
		Um mehr über uns zu erfahren, können Sie sich unter dem Menüprojekt <b>"Das Projekt"</b> näher über uns informieren. Sollte Sie der Hintergrund der Applikation näher interessieren, so können Sie darüber mehr unter dem Link
		<a href="{{ route('application') }}">Die Idee</a>. Mehr über unser Team hingegen erfahren Sie <a href="{{ route('team') }}">hier</a>.</p>
		
		<p>Wir hoffen, dass wir Sie für unsere Applikation interessieren konnten und wünschen einen schönen Tag.</p>
		<p>Wir freuen uns auf Sie!</p>
		<blockquote>Jan Meier und Natalie Schumacher</blockquote>
	</div>
</div>

@stop
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="../../favicon.ico">

    <title>Wurfgenerator - @yield('title')</title>

    <!-- Bootstrap core CSS -->
	<link href="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/css/custom.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/css/carousel.css') }}" rel="stylesheet" type="text/css">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
	@include('site.navigation')
  
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
	
    <div class="container information">

		<div class="row headercontainer">
			<div class="col-md-12">
			<img class="img img-responsive header" src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/images/header.jpg') }}"/>
			</div>
		</div>
	
      <!-- Three columns of text below the carousel -->
      <div class="row">
		
		<div class="col-lg-4">
          <h2>Über das Projekt</h2>
          <p>Interesse daran, herauszufinden, wie das Projekt zustande gekommen ist?</p>
          <p><a class="btn btn-default" href="{{ route('application') }}" role="button">Über das Projekt nachlesen &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Farbenbuch</h2>
          <p>Übersicht über verschiedene Farbgruppen.</p>
          <p><a class="btn btn-default" href="{{ route('guineapig-colorbook') }}" role="button">Farbenbuch ansehen &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h2>Rassenbuch</h2>
          <p>Übersicht über alle von dieser Applikation verwertbaren Rassen.</p>
          <p><a class="btn btn-default" href="{{ route('guineapig-racebook') }}" role="button">Rassenbuch ansehen &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <!-- /.col-lg-4 -->
      </div><!-- /.row -->
      <!-- /END THE FEATURETTES -->
		
		@yield('master-content')
	  

      <!-- FOOTER -->
      <footer>
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>&copy; 2015/2016 IDPA Jan Meier & Natalie Schumacher</p>
	  </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/js/custom.js') }}"></script>
	<script src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/js/CreateLitter.js') }}"></script>
	<script src="{{ URL::asset('http://localhost/GuineaPigIDPA2/server.php/public/js/CreateGuineaPig.js') }}"></script>
  </body>
</html>

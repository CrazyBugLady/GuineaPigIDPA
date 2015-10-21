    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ route('') }}">Wurfgenerator</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Über das Projekt<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="team">Das Team</a></li>
                    <li><a href="application">Die Applikation</a></li>
                  </ul>
                </li>
				@if ($user != null)
				<li><a href="{{ route('litter-overview') }}">Aktuell</a></li>
				<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zucht administrieren<span class="caret"></span></a>
                  <ul class="dropdown-menu">
					<li><a href="{{ route('breeding-overview') }}">Zuchtenübersicht</a></li>
					<li><a href="{{ route('create-breeding') }}">Neue Zucht</a></li>
					<hr>
					@foreach ($breedings as $breeding)
						<li><a href="{{ route('guineapigs-overview') }}/{{{ $breeding->ID }}}">{{{ $breeding->Name }}}</a></li>
					@endforeach
                  </ul>
                </li>
				@endif
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genetik How To <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="colorgenetics">Farbgenetik</a></li>
                    <li><a href="racegenetics">Rassegenetik</a></li>
                  </ul>
                </li>
              </ul>
				<ul class="nav navbar-nav navbar-right">
					@if ($user == null)
					<li><a href="{{ route('register') }}" class="btn btn-primary">Register</a></li>
					<li><a href="{{ route('auth/login') }}" class="btn btn-success">Sign in</a></li>
					@else
					<li><a href="sign" class="btn btn-danger">Sign out</a></li>
					@endif
				</ul>
            </div>
			
			
          </div>
        </nav>

      </div>
    </div>
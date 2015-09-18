@extends('site.master')

@section('master-content')
    <!-- Notifications -->
    <div class="row">
        <div class="col-md-12">
            @include('site.notifications')
        </div>
    </div>
    
    <!-- Content -->
    @yield('default-content')
@stop
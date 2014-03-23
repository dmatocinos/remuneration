@section('content')
	<legend><h1>Remuneration</h1></legend>
	<legend><h3>You are not yet subscribed to this application.</a></h3></legend>
	<div class="form-group">
	  <!-- <a class="pull-right" href="#">Forgot password?</a> -->
	  <label>{{ $msg }} </label>
	</div>
	<div class="form-group" style="text-align: center;">
		<a style="font-size: 18px; float: center; width: 100%;" class="text-center btn btn-primary" href="{{ url('start_payment') }}"> Subscribe now! </a>
	</div>
	<div class="form-group" style="text-align: center;">
		<a class="btn btn-primary" href="{{ url('logout') }}"> Logout </a>
	</div>
@stop

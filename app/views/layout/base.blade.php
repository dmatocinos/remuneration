<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Remuneration Pro</title>
    {{ Asset::container('header')->styles() }}

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Remuneration Pro</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Sentry::getUser()->email }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
			<!--
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>Help</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
			-->
                       <!-- <li class="divider"></li> -->
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        <!--</li>-->
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
			@if (isset($edit_remuneration))
				<li class="active">
					<a href="#"><i class="fa fa-book fa-fw"></i> {{ $edit_remuneration }}</a>
				</li>
			@endif
                    <li class="{{ $side_nav_css_class['create'] }}">
                        <a href="{{ url('create') }}"><i class="fa fa-plus-square-o fa-fw"></i> Create New</a>
                    </li>
                    <li class="{{ $side_nav_css_class['home'] }}">
                        <a href="{{ url('home') }}"><i class="fa fa-dashboard fa-fw"></i> My Remunerations</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
		
		<div class="notifications bottom-left">
			<div style="float:left; width: 240px;">
				<div class="form-group" style="width: 200px;">
					<a href="http://bizvaluationpro.practicepro.co.uk" target="_blank" title="Create a professional business valuation in just 15 minutes">
						<img src="{{ asset('images/logos/bizval.png') }}" style="margin-left:30px; width: 10%; margin-top:15px; width: 100%;">
					</a>
				</div>
				<div class="form-group" style="width: 200px;">
					<a href="http://virtualfdpro.practicepro.co.uk" target="_blank" title="Help your clients achieve their goals">
						<img src="{{ asset('images/logos/vfd.png') }}" style="margin-left:30px; width: 10%; margin-top: 15px; width: 100%;">
					</a>
				</div>
				<div class="form-group" style="width: 200px;">
					<a href="http://priceplannerpro.practicepro.co.uk" target="_blank" title="Price professionally and create additional fees">
						<img src="{{ asset('images/logos/priceplan.png') }}" style="margin-left:30px; width: 10%; margin-top: 15px; width: 100%;">
					</a>
				</div>
			</div>
		</div>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				@yield('content')
			</div>
		</div>
	</div><!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    {{ Asset::container('footer')->scripts() }}

</body>

</html>

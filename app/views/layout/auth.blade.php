<!DOCTYPE html>

<html class="full" lang="en"><!-- The full page image background will only work if the html has the custom class set to it! Don't delete it! -->

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dixie Philamerah Atay">

    <title>Remuneration</title>

    <!-- Custom CSS for the 'Full' Template -->
    {{ Asset::container('header')->styles() }}
  </head>

  <body>

    <div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-7 blob">
				<h2 style="margin-top: 0px;">The Next Big Thing in the Cloud</h2>
				<p>Remuneration PlannerPro is a refined piece of software that helps PracticePro members extract funds from their clients companies in the most tax efficient manner.</p>
				<p>Before Remuneration PlannerPro, clients were probably limited to simply whether they should take a dividend or a bonus. But now PracticePro’s innovative software compares numerous strategies for extracting funds while also accounting for the personal taxable income of each respective business owner.</p>
				<p>The beauty of Remuneration PlannerPro is that not only will you be presented with the most tax efficient options, but it will save you an incredible amount of time. You will not have to undertake tedious and time consuming calculations; with a click of a button the unique software does everything for you.</p>
				<p>Remuneration PlannerPro also delivers a beautiful end product, presenting two powerful reports. All of the appropriate figures will be included as well as explanations to the potential tax savings and information on each strategy.</p>
				<br />
				<h4>See other services we offer:</h4>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div style="width: 290px; float: left; height: 80px; margin-right: 20px;">
							<a href="http://app.bizvaluation.co.uk" target="_blank" title="Create a professional business valuation in just 15 minutes" class="thumbnail" style="height: 60px">
								<img src="{{ url('images/logos/bizval.png') }}" style="width: 60%; margin-top: 10px; padding-bottom: 5px;"/>
							</a>
						</div>
						<div style="width: 290px; float: left; height: 80px; margin-right: 20px;">
							<a href="http://virtualfdpro.practicepro.co.uk" target="_blank" title="Help your clients achieve their goals" class="thumbnail" style="height: 60px">
								<img src="{{ url('images/logos/vfd.png') }}" style="width: 60%; margin-top: 10px;"/>
							</a>
						</div>
						<div style="width: 290px; float: left; height: 80px; margin-right: 20px;">
							<a href="http://priceplannerpro.practicepro.co.uk" target="_blank" title="Price professionally and create additional fees"class="thumbnail" style="height: 60px">
								<img src="{{ url('images/logos/priceplan.png') }}" style="width: 60%; margin-top: 10px;"/>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 pull-right">
				<div class="main well">
					@yield('content')
				</div>
			</div>
		</div>
    </div>
   
    <!-- JavaScript -->
    {{ Asset::container('footer')->scripts() }}

  </body>

</html>

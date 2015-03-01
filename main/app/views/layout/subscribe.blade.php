<!DOCTYPE html>

<html class="full" lang="en"><!-- The full page image background will only work if the html has the custom class set to it! Don't delete it! -->

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dixie Philamerah Atay">
    <meta name="publishable-key" content="{{ Config::get('stripe.publishable_key') }}">

    <title>Remuneration</title>

    <!-- Custom CSS for the 'Full' Template -->
    {{ Asset::container('header')->styles() }}
  </head>

  <body>

    <div class="container">
      <div class="row">
		<div class="col-lg-8 col-lg-offset-2 main well" style="text-align: center;">
				@yield('content')
			</div>
		</div>
      </div>
    </div>
    
    <!-- JavaScript -->
    <script src="https://js.stripe.com/v2/"></script>
    <!-- JavaScript -->
    {{ Asset::container('footer')->scripts() }}

  </body>

</html>

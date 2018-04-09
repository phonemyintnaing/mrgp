<html lang="en">
<head>
	<title>Laravel 5.6</title>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/angular-1.6.9/jquery.min.js"></script>

 
	<script src="js/angular-1.6.9/bootstrap.min.js"></script>
	<!-- Angular JS -->

		<!--	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script> -->
	<script src="js/angular-1.6.9/angular.min.js"></script>  
	<script src="js/angular-1.6.9/angular-route.min.js"></script>
	<!-- MY App -->
	<script src="{{ asset('/app/packages/dirPagination.js') }}"></script>
	<script src="{{ asset('/app/routes.js') }}"></script>
	<script src="{{ asset('/app/services/myServices.js') }}"></script>
	<script src="{{ asset('/app/helper/myHelper.js') }}"></script>
	<!-- App Controller -->
	<script src="{{ asset('/app/controllers/ItemController.js') }}"></script>
</head>
<body ng-app="main-App">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel 5.2</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#/">Home</a></li>
					<li><a href="#/items">Item</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<ng-view></ng-view>
	</div>
</body>
</html>
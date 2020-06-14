<html lang="en">
<head>
	<title>Mr. GP</title>
	<!-- Fonts -->
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/angular-1.3.2/jquery.min.js"></script>

 
	<script src="js/angular-1.3.2/bootstrap.min.js"></script>
	<!-- Angular JS -->

		<!--	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script> -->
	<script src="js/angular-1.3.2/angular.min.js"></script>  
	<script src="js/angular-1.3.2/angular-route.min.js"></script>
	<!-- MY App -->
	<script src="{{ asset('/app/packages/dirPagination.js') }}"></script>
	<script src="{{ asset('/app/routes.js?ver=1.1') }}"></script>
	<script src="{{ asset('/app/services/myServices.js') }}"></script>
	<script src="{{ asset('/app/helper/myHelper.js') }}"></script>
	<!-- App Controller -->
    <script src="{{ asset('/app/controllers/ItemController.js?ver=1.1') }}"></script>
    <script src="{{ asset('/app/controllers/PatientsController.js?ver=1.2') }}"></script>
    <script src="{{ asset('/app/controllers/HistoriesController.js?ver=1.3') }}"></script>
    <script src="{{ asset('/app/controllers/RecordsController.js?ver=1.2') }}"></script>
    <script src="{{ asset('/app/controllers/ClintonController.js?ver=1.1') }}"></script>
</head>
<body ng-app="main-App">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" style="float: right;">
					<ul class="nav nav-pills" style="float: right;">
					 <!--   <li class="active"><a data-toggle="pill" href="#">English	<img src="/mrgp/public/img/eng.png" alt="Myanmar" >
						</a></li>
					    <li><a data-toggle="pill" href="#patients_my">Myanmar
							<img src="/mrgp/public/img/myanmar.png" alt="Myanmar" >
					    </a></li> -->
					    <li>
					    		<p class="condensedlines">
					    		</p>
							   <input type="button" class="btn btn-danger btn-md"  onclick="location.href='/logout';" value="Log Out" />

					    </li>
					  </ul>
			 </div>

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"  style="padding-top:10px">Mr. GP</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav nav-pills">
					<li ><a href="#">Patient Registration</a></li>
					<li><a href="#/records">Daily Visits</a></li>
					<li><a href="#/clinton">Billing Information</a></li>
				<!--	<li><a href="#/items"></a></li>
					<li><a href="#/patients"></a></li> -->

				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<ng-view></ng-view>
	</div>
</body>
</html>
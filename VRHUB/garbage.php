<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
	header("location:index.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Map</title>

	<!-- Bootstrap CSS -->
	<link href="common/css/bootstrap.min.css" rel="stylesheet">
	<link href="common/css/material-kit.css" rel="stylesheet">
	<link href="common/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<link href="common/css/material-icons.css" rel="stylesheet">
	<link href="common/css/demo.css" rel="stylesheet">
	<link href="src/index.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body class="index-page">
			<!-- Navbar -->
			<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll" style="padding: 0;">  <!-- added padding to make the navbar decrease the height -->
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="map.php">
							<div class="logo-container">
								<div class="logo">
									<img src="assets/img/logo.png" alt="Creative Tim Logo" rel="tooltip" data-placement="bottom" data-html="true">
								</div>
								<div class="brand" style="margin-top: 18px;">
									VR HUB
								</div>


							</div>
						</a>
					</div>

					<div class="collapse navbar-collapse" id="navigation-index">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="map.php">
									<i class="material-icons">map</i> Map
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">navigation</i> location
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="2quad/2quad.php"><i class="material-icons">place</i> 2Quad</a></li>
									<li><a href="avalon/avalon.php"><i class="material-icons">place</i> Avalon</a></li>
									<li><a href="lgf1/lgf1.php"><i class="material-icons">place</i> La Guardia Flats 1</a></li>
									<li><a href="lgf2/lgf2.php"><i class="material-icons">place</i> La Guardia Flats 2</a></li>
									<li><a href="clip/clip.php"><i class="material-icons">place</i> Clip</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="material-icons">face</i> admin
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="logout.php"><i class="material-icons">keyboard_return</i> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- End Navbar -->

			<div class="wrapper">
				<div class="header" style="background-image: url('assets/img/2quadbuilding.png'); height: 55vh;">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<div class="brand" style="margin-top: 20vh;">
									<h1>HR VR TOUR</h1>
									<h3>a virtual reality tour inside our building</h3>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="main main-raised">
					<div class="section section-basic" style="padding: 0;"> <!-- added padding to remove the padding in the bottom -->
						<!-- <div class="page-header" style="margin: 40px 300px 20px; border-bottom: 3px solid #000000;"> -->
							<center><h3>Cebu Map</h3></center>
						<!-- </div> -->
						<!-- <div class="container" style="margin-top: 15px;"> --> <!-- class container is removed to make the map fit to the class section section-basic as its container -->
							<style>
								#map {
									height: 700px;
									width: 100%;
								}
							</style>
							<div id="map"></div>
						<!-- </div> -->
					</div>
				</div>

				<footer class="footer">
					<div class="container">
						<div class="copyright pull-right">
							&copy; 2017, Created by MIS
						</div>
					</div>
				</footer>
			</div>

		</body>
		<script src="common/js/jquery.min.js" type="text/javascript"></script>
		<script src="common/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="common/js/material.min.js"></script>

		<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
		<script src="common/js/nouislider.min.js" type="text/javascript"></script>

		<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
		<script src="common/js/bootstrap-datepicker.js" type="text/javascript"></script>

		<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
		<script src="common/js/material-kit.js" type="text/javascript"></script>

		<script type="text/javascript">

			$().ready(function(){
				// the body of this function is in assets/material-kit.js
				materialKit.initSliders();
				window_width = $(window).width();

				if (window_width >= 992){
					big_image = $('.wrapper > .header');

					$(window).on('scroll', materialKitDemo.checkScrollForParallax);
				}

			});
		</script>
		<script>
			function initMap() {
				//variables for waypoints
				var directionsServiceLGF1 = new google.maps.DirectionsService;
		        var directionsDisplayLGF1 = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceLGF2 = new google.maps.DirectionsService;
		        var directionsDisplayLGF2 = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.
		        
				var directionsServiceAvalon = new google.maps.DirectionsService;
		        var directionsDisplayAvalon = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.
		       
				var directionsServiceClipA = new google.maps.DirectionsService;
		        var directionsDisplayClipA = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.
				
				var directionsServiceClipB = new google.maps.DirectionsService;
		        var directionsDisplayClipB = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceStJohn = new google.maps.DirectionsService;
		        var directionsDisplayStJohn = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceMGF = new google.maps.DirectionsService;
		        var directionsDisplayMGF = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceEAT = new google.maps.DirectionsService;
		        var directionsDisplayEAT = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceMM = new google.maps.DirectionsService;
		        var directionsDisplayMM = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceMH = new google.maps.DirectionsService;
		        var directionsDisplayMH = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceEN = new google.maps.DirectionsService;
		        var directionsDisplayEN = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.

				var directionsServiceSM = new google.maps.DirectionsService;
		        var directionsDisplaySM = new google.maps.DirectionsRenderer({suppressMarkers: true}); //suppressMarkers removes the default marker e.g: A, B etc.
		        //variables for way points
	   			

		        

				var ulurua = {lat: 10.314291, lng: 123.905279};
				var ulurub = {lat: 10.329193, lng: 123.903982};
				var uluruc = {lat: 10.331583, lng: 123.904338};
				var ulurud = {lat: 10.316291, lng: 123.904344};
				var ulurue = {lat: 10.288038, lng: 123.960269};
				var uluruf = {lat: 10.305767, lng: 123.898923};
				var ulurug = {lat: 10.319378, lng: 123.912979};
				var uluruh = {lat: 10.338457, lng: 123.953847};
				var ulurui = {lat: 10.338304, lng: 123.954172};
				var uluruj = {lat: 10.242547, lng: 123.798016};
				var uluruk = {lat: 10.368265, lng: 123.927895};
				var ulurul = {lat: 10.322090, lng: 123.914076};

				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 8,
					streetViewControl: false,
					center: ulurua
				});
				//codes for waypoints
				directionsDisplayLGF1.setMap(map);
		   		calculateAndDisplayRouteLGF1(directionsServiceLGF1, directionsDisplayLGF1);

				directionsDisplayLGF2.setMap(map);
		   		calculateAndDisplayRouteLGF2(directionsServiceLGF2, directionsDisplayLGF2);
	   		
	   			directionsDisplayAvalon.setMap(map);
		   		calculateAndDisplayRouteAvalon(directionsServiceAvalon, directionsDisplayAvalon);

	   			directionsDisplayClipA.setMap(map);
		   		calculateAndDisplayRouteClipA(directionsServiceClipA, directionsDisplayClipA);
	   			
	   			directionsDisplayClipB.setMap(map);
		   		calculateAndDisplayRouteClipB(directionsServiceClipB, directionsDisplayClipB);
	   			
	   			var destStJohn = 'St. John Dormitory, F. Ramos Street, Cebu City, Cebu';
	   			directionsDisplayStJohn.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceStJohn, directionsDisplayStJohn, destStJohn);

	   			var destMGF = 'Mabolo Garden Flats, Cebu City, Cebu';
	   			directionsDisplayMGF.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceMGF, directionsDisplayMGF, destMGF);
	   			
	   			var destEAT = 'East aurora Tower Condominum Corporation, Cebu City, Cebu';
	   			directionsDisplayEAT.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceEAT, directionsDisplayEAT, destEAT);

	   			var destMM = '10.338457, 123.953825';
	   			directionsDisplayMM.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceMM, directionsDisplayMM, destMM);

	   			var destMH = 'Maayo Hotel, Plaridel Street, Umapad, Mandaue City, Cebu';
	   			directionsDisplayMH.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceMH, directionsDisplayMH, destMH);

	   			var destEN = "10.368251, 123.927906";
	   			directionsDisplayEN.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceEN, directionsDisplayEN, destEN);

	   			var destSM = "Spark Commercial Center, Minglanilla";
	   			directionsDisplaySM.setMap(map);
		   		calculateAndDisplayRoute(directionsServiceSM, directionsDisplaySM, destSM);
	   			//codes for waypoints
	   			//code for waypoints and calculations

function calculateAndDisplayRoute(directionsService, directionsDisplay, destination) {
        var waypts = [];

        directionsService.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: destination,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'WALKING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplay.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }
		function calculateAndDisplayRouteClipA(directionsService, directionsDisplay) {
        var first = new google.maps.LatLng(10.338502, 123.954826);
        var second = new google.maps.LatLng(10.321649, 123.968243);
        var waypts = [{location: first, stopover: false},
        			  {location: second, stopover: false}];

        directionsService.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: "CLIP Rd 2, Lapu-Lapu City, Cebu",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              /*summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';*/

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplay.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }
function calculateAndDisplayRouteClipB(directionsService, directionsDisplay) {
        var first = new google.maps.LatLng(10.330367, 123.947884);
        var second = new google.maps.LatLng(10.313843, 123.958847);
        var waypts = [{location: first, stopover: false},
        			  {location: second, stopover: false}];

        directionsService.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: "CLIP Rd 2, Lapu-Lapu City, Cebu",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              /*summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';*/

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplay.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }
//code for waypoints and calculations
		function calculateAndDisplayRouteAvalon(directionsService, directionsDisplay) {
			var first = new google.maps.LatLng(10.316205, 123.905841);
            var second = new google.maps.LatLng(10.316965, 123.904020);
            var third = new google.maps.LatLng(10.316836, 123.903938);
            var fourth = new google.maps.LatLng(10.316480, 123.904539);
        var waypts = [{location: first, stopover: false},
                       {location: second, stopover: false},
                       {location: third, stopover: false}
                       /*{location: fourth, stopover: false}*/];
        /*var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }*/

        directionsService.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: "10.316387, 123.904662",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              // summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            /*summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';*/
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplay.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }

//code for waypoints and calculations
		function calculateAndDisplayRouteLGF2(directionsServiceLGF2, directionsDisplayLGF2) {
			var waypts = [];
        directionsServiceLGF2.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: "La Guardia Flats 2, First Street La Guatdia, Cebu City, Cebu",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplayLGF2.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              // summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            /*summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';*/
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplayLGF2.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }
      //code for waypoints and calculations
		function calculateAndDisplayRouteLGF1(directionsServiceLGF1, directionsDisplayLGF1) {
			var waypts = [];
			
        directionsServiceLGF1.route({
          origin: "2Quad Building, Cardinal Rosales Ave, Cebu City, Cebu",
          destination: "La Guardia Flats 1 Condominium, La Guardia Street, Cebu City, Cebu",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplayLGF1.setDirections(response);
            var route = response.routes[0];
            var totalDistance = '';
            var replaceKm = 0;
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              // summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

              totalDistance = route.legs[i].distance.text;
              replaceKm += Number(totalDistance.replace('km',''));
            } 
            /*summaryPanel.innerHTML += route.legs[0].start_address + ' TO <br/>';
            summaryPanel.innerHTML += route.legs[1].end_address + ' VIA <br/>';
            summaryPanel.innerHTML += route.legs[0].end_address + ' <br/>';*/
            summaryPanel.innerHTML += replaceKm.toFixed(2) + ' km';
          } else {
           directionsDisplayLGF1.set('directions', null);
           document.getElementById('directions-panel').innerHTML = '';

          }
        });
      }
      //end of code for way points and calculations

				// set boundary limit when user uses the drag event
				var strictBounds = new google.maps.LatLngBounds(
				new google.maps.LatLng(9.719788699999999, 122.49200880000001),
				new google.maps.LatLng(11.8240433, 124.84034080000004));

				// Listen for the dragend event
				 google.maps.event.addListener(map, 'dragend', function () {
				     if (strictBounds.contains(map.getCenter())) return;

				     // We're out of bounds - Move the map back within the bounds

				     var c = map.getCenter(),
				         x = c.lng(),
				         y = c.lat(),
				         maxX = strictBounds.getNorthEast().lng(),
				         maxY = strictBounds.getNorthEast().lat(),
				         minX = strictBounds.getSouthWest().lng(),
				         minY = strictBounds.getSouthWest().lat();

				     if (x < minX) x = minX;
				     if (x > maxX) x = maxX;
				     if (y < minY) y = minY;
				     if (y > maxY) y = maxY;

				     map.setCenter(new google.maps.LatLng(y, x));
				 });

				google.maps.event.addListener(map, 'zoom_changed', function () {
			     if (map.getZoom() < 8) map.setZoom(8);
			 	});


				/*set markers for each sites*/

				var marker1 = new google.maps.Marker({
					position: ulurua,
					map: map,
					icon: 'src/icon_marker.png',
					title: '2Quad',
					url: '2quad/2quad.php'

				});

				marker1.addListener('click', function() {
					window.location.href = this.url;
				});

				var marker2 = new google.maps.Marker({
					position: ulurub,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'La Guardia Flats 2',
					url: 'lgf2/lgf2.php'

				});

				marker2.addListener('click', function() {		   
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;
       });

				var marker3 = new google.maps.Marker({
					position: uluruc,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'La Guardia Flats 1',
					url: 'lgf1/lgf1.php'

				});

				marker3.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;
       });


		
				var marker4 = new google.maps.Marker({
					position: ulurud,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Avalon',
					url: 'avalon/avalon.php'
					
				});

				marker4.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;
       });
				var marker5 = new google.maps.Marker({
					position: ulurue,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Clip',
					url: 'clip/clip.php'

				});
				
				marker5.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});
				var markerf = new google.maps.Marker({
					position: uluruf,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'St. John Dormitory',
					// url: 'clip/clip.php'

				});
				
				/*markerf.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/


			var markerMGF = new google.maps.Marker({
					position: ulurug,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Mabolo Garden Flats	',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/
			var markerMH = new google.maps.Marker({
					position: uluruh,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Maayo Hotel	',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/
			var markerMM = new google.maps.Marker({
					position: ulurui,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Maayo Medical',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/
			var markerSM = new google.maps.Marker({
					position: uluruj,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Spark Minglanilla',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/
				var markerEN = new google.maps.Marker({
					position: uluruk,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'Eagles Nest',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/
			var markerEAT = new google.maps.Marker({
					position: ulurul,
					map: map,
					icon: 'src/icon_marker.png',
					title: 'East Aurora Tower',
					// url: 'clip/clip.php'

				});
				/*
				markerMGF.addListener('click', function() {
           //map.setZoom(20);
           //map.setCenter(marker.getPosition());
           window.location.href = this.url;


		});*/

				//calculates distance between two points in km's
			function calcDistance(p1, p2) {
			  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2) + " km";
			}

			// calculate distance from 2quad to other buildings
				var origin = new google.maps.LatLng(ulurua['lat'], ulurua['lng']);

				//to clip
				var destClip = new google.maps.LatLng(ulurue['lat'], ulurue['lng']);
				
				//to La Guardia Flats 1
				var destFlat2 = new google.maps.LatLng(uluruc['lat'], uluruc['lng']);

				//to La Guardia Flats 2
				var destFlat1 = new google.maps.LatLng(ulurub['lat'], ulurub['lng']);
				//to Avalon
				var destAvalon = new google.maps.LatLng(ulurud['lat'], ulurud['lng']);
				//to St. John Dormitory
				var destStJohn = new google.maps.LatLng(uluruf['lat'], uluruf['lng']);


				//2Quad
				var markerContent0 = "<div>2Quad Building</div><div><img src='assets/images/2quad/2quad_2.jpg' alt='2Quad Building' class='infoWindowImages'></div><div>Distance from 2Quad: </div></div>";
				var infowindow0 = new google.maps.InfoWindow({
					content: markerContent0,
					maxWidth: 350
				});
				marker1.addListener('mouseover', function() {
            		infowindow0.open(map, marker1);
            	});
            	marker1.addListener('mouseout', function (){
				infowindow0.close(map, marker1);
				});


				//La Guardia Flats 2
				var markerContent1 = "<td='50%'><img src='assets/images/la_guardia_flats_2/la_guardia_2.jpg' alt='La Guardia Flats 2' class='infoWindowImages'>";
				var infowindow1 = new google.maps.InfoWindow({
					content: markerContent1,
					maxWidth: 350
				});
				marker2.addListener('mouseover', function() {

            		infowindow1.open(map, marker2);
            	});
            	marker2.addListener('mouseout', function (){
				infowindow1.close(map, marker2);
				});


            	//La Guardia Flats 1
				var markerContent2 = "<div>La Guardia Flats 1<img src='assets/images/la_guardia_flats_1/la_guardia_1.jpg' class='infoWindowImages'/></div><div><span>Distance from 2Quad: "+ calcDistance(origin, destFlat1);+"</span></div>";
				var infowindow2 = new google.maps.InfoWindow({
					content: markerContent2,
					maxWidth: 350
				});
				marker3.addListener('mouseover', function() {
            		infowindow2.open(map, marker3);
            	});
            	marker3.addListener('mouseout', function (){
				infowindow2.close(map, marker3);
				});


				//Avalon
				var markerContent3 = "<div>Avalon<img src='assets/images/avalon/avalon.jpg' class='infoWindowImages' /></div><div><span>Distance from 2Quad: "+ calcDistance(origin, destAvalon);+"</span></div>";
				var infowindow3 = new google.maps.InfoWindow({
					content: markerContent3,
					maxWidth: 350
				});
				marker4.addListener('mouseover', function() {
            		infowindow3.open(map, marker4);
            	});
            	marker4.addListener('mouseout', function (){
				infowindow3.close(map, marker4);
				});


				//Clip
				var markerContent4 = "<div>Clip</div><div><span>Distance from 2Quad: "+ calcDistance(origin, destClip);+"</span></div>";
				var infowindow4 = new google.maps.InfoWindow({
					content: markerContent4,
					maxWidth: 350
				});
				marker5.addListener('mouseover', function() {
            		infowindow4.open(map, marker5);
            	});
            	marker5.addListener('mouseout', function (){
				infowindow4.close(map, marker5);
				});

				//St. John Dormitory
				var markerContentf = "<div>St. John Dormitory</div><div><span>Distance from 2Quad: "+ calcDistance(origin, destStJohn);+"</span></div>";
				var infowindowf = new google.maps.InfoWindow({
					content: markerContentf,
					maxWidth: 350
				});
				markerf.addListener('mouseover', function() {
            		infowindowf.open(map, markerf);
            	});
            	markerf.addListener('mouseout', function (){
				infowindowf.close(map, markerf);
				});

				

			

			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-7SUVYEGo5vPrEHxNdH1h2REVdQpu6o&libraries=geometry&callback=initMap"></script>
		</html>
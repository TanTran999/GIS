<?php
    include "buildjson.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
	<title>Sample Map</title>

	<style>
		html,
		body,
		#viewDiv {
			padding: 0 !important;
			margin: 0 !important;
			height: 100% !important;
			width: 100% !important;
		}

		#back {
			position: absolute;
			bottom: 20px;
		}

		#back i {
			background-image: url(app/public/img/back.svg);
			background-repeat: no-repeat;
			display: inline-block;
			width: 100px;
			height: 25px;
			padding-left: 25px;
			padding-top: 2px;
			margin: 10px;
			cursor: pointer;
			background-size: 20px;
		}
	</style>

	<link rel="stylesheet" href="https://js.arcgis.com/4.16/esri/themes/light/main.css" />
	<script src="https://js.arcgis.com/4.16/"></script>

	<script>
		require([
			"esri/Map",
			"esri/views/SceneView",
			"esri/layers/GeoJSONLayer",
			"esri/layers/SceneLayer", "esri/layers/GraphicsLayer", "esri/Graphic", "esri/request"
		], function (Map, SceneView, GeoJSONLayer, SceneLayer,
			GraphicsLayer, Graphic, esriRequest) {
			var createGraphic = function (data) {
				return new Graphic({
					geometry: data,
					symbol: data.symbol,
					attributes: data,
					popupTemplate: data.popupTemplate
				});
			};

			const json_options = {
				query: {
					f: "json"
				},
				responseType: "json"
			};
			// request json
			esriRequest('assets/data/result.json', json_options).then(function (response) {
				var graphicsLayer = new GraphicsLayer();
				console.log(response);
				response.data.forEach(function (data) {
					graphicsLayer.add(createGraphic(data));
				});
				map.add(graphicsLayer);

			});

			const map = new Map({
				basemap: "topo-vector",
				ground: "world-elevation",
			});

			const view = new SceneView({
				container: "viewDiv",
				map: map,
				camera: {
					position: [106.72133304322159, 10.789093797186482, 1300],
					heading: 0,
					tilt: 30
				}
			});

			view.popup.defaultPopupTemplateEnabled = true;
		});

	</script>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

	<link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">

	<script src="assets/js/jquery-2.1.0.min.js"></script>

	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/scrollreveal.min.js"></script>
	<script src="assets/js/waypoints.min.js"></script>
	<script src="assets/js/jquery.counterup.min.js"></script>
	<script src="assets/js/imgfix.min.js"></script>

	<script src="assets/js/custom.js"></script>
</head>

<body>
	<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">

                        <a href="#" class="logo" style="margin: 5px 0px 0px 20px !important;">
                            <img src="assets/images/logo.png" alt="UIT" style="height:65px;" />
                        </a>

                        <ul class="nav">
                            <li><a href="#welcome" class="active">Home</a></li>
                            <li><a href="#testimonials">About</a></li>
                            <li><a href="#viewDiv">Map</a></li>
                            <li><a href="#pricing-plans">Pricing plans</a></li>
                            <li><a href="#contact-us">Contact</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>

                    </nav>
                </div>
            </div>
        </div>
    </header>

	<div class="welcome-area" id="welcome">

        <div class="header-text">
        </div>
    </div>
    </div>

	<section class="section" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Lorem ipsum dolor sit amet</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="team-item">
                        <div class="team-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

	<div id="viewDiv" style="height: 73% !important; padding-left: 50px !important; padding-right: 50px !important; padding-bottom: 50px !important;"></div>

	<section class="section colored" id="pricing-plans">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Pricing Plans</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6 col-sm-12"
                    data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Lorem ipsum</h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">$</span>
                                <span class="price">500</span>
                                <span class="period">Lorem ipsum </span>
                            </div>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12"
                    data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                    <div class="pricing-item active">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Lorem ipsum </h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">$</span>
                                <span class="price">700</span>
                                <span class="period">Lorem ipsum </span>
                            </div>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12"
                    data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                    <div class="pricing-item">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Lorem ipsum </h3>
                        </div>
                        <div class="pricing-body">
                            <div class="price-wrapper">
                                <span class="currency">$</span>
                                <span class="price">1000</span>
                                <span class="period">Lorem ipsum </span>
                            </div>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="main-button">Purchase Now</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

	<section class="section colored" id="contact-us">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="center-heading">
                        <h2 class="section-title">Lorem ipsum</h2>
                    </div>
                </div>
                <div class="offset-lg-3 col-lg-6">
                    <div class="center-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-form">
                        <form id="contact" action="" method="get">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name"
                                            placeholder="Full Name" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="email" class="form-control" id="email"
                                            placeholder="E-Mail Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message"
                                            placeholder="Your Message" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12" style="text-align:center;">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button">Send Message</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

	<footer>
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2021 UIT 17521018</p>
                </div>
            </div>
        </div>
    </footer>

	<script src="assets/js/jquery-2.1.0.min.js"></script>

    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>

    <script src="assets/js/custom.js"></script>

</body>

</html>
<?php
	session_start();
	if (!function_exists("curl_init")) die("cURL extension is not installed");

	$msisdn = "";
	$s_destination = "";
	$s_origin = "";
	$s_date = "";
	if (!isset($_GET['msisdn'])) {
		header("Location:https://line.me/R/ti/p/%40bangjoni");
	} else {
		$msisdn = $_GET['msisdn'];
	}
	if (isset($_GET['d'])) {
		$s_origin = $_GET['d'];
	}
	if (isset($_GET['a'])) {
		$s_arrival = $_GET['a'];
	}
	if (isset($_GET['date'])) {
		$s_date = date("d-m-Y", strtotime($_GET['date']));
	}

	$agent = 'twh:[21060440];[kenzie_tiket];';

	$url = 'https://api.tiket.com/apiv1/payexpress?method=getToken&secretkey=a2d4c49553532e84867c1b07be914f97&output=json';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$r = curl_exec($ch);
	if($errno = curl_errno($ch)) {
		$error_message = curl_strerror($errno);
		echo "cURL error ({$errno}):\n {$error_message}";
	}
	curl_close($ch);
	$diagnostic = json_decode($r);
	if (strcmp($diagnostic->diagnostic->confirm,"success") == 0) {
		$token = $diagnostic->token;
	}


	//echo $token;

	$url = 'https://api.tiket.com/flight_api/all_airport?token='. $token .'&output=json';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$r = curl_exec($ch);
	if($errno = curl_errno($ch)) {
		$error_message = curl_strerror($errno);
		echo "cURL error ({$errno}):\n {$error_message}";
	}
	curl_close($ch);
	//echo $r;
	$diagnostic = json_decode($r);
	if (strcmp($diagnostic->diagnostic->confirm,"success") == 0) {
		$airports = $diagnostic->all_airport->airport;
		$_SESSION['airports'] = $airports;
	}
?>





<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Travel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" /> -->
	<!-- <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" /> -->
<!-- 	<meta name="author" content="FREEHTML5.CO" /> -->



<!-- @import url('https://fonts.googleapis.com/css?family=Montserrat');
font-family: "Montserrat", Montserrat, Arial, sans-serif; -->
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<!-- CS Select -->
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/select2.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body class="bgImg" style="background-image: url(images/Asset/background.png);">
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="loading-modal">
			<div class="vertical-alignment-helper">
			  <div class="modal-dialog vertical-align-center" role="document">
			    <div class="modal-content" style="background:none;position: absolute;left: 50%;top: 50%;-webkit-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
			      <div class="image_container" style="background:none">
							<img src="images/Asset/loading.gif" />
						</div>
			    </div>
			  </div>
			</div>
		</div>

		<header class="navHead">
			<div class="container">
				<div style="width:85px; float: left;">
					<img src="images/Asset/bangJoni.png" class="" style="height:auto; width: 80px;">
				</div>

				<div class="textBox">
					<span><img src="images/Asset/chevron.png" class="dialog"></span>
					Nah, sekarang tinggal pilih jadwal pesawat yang kamu inginkan deh.
				</div>
			</div>
		</header>

		<!-- end:header-top -->

		<div class="">
			<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="tabulation animate-box">

								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active" style="width: 48%; text-align: center;">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">ONE WAY</a>
								      </li>
								      <li role="presentation" style="width: 48%; text-align: center; float:right;">
								    	   <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">ROUND TRIP</a>
								      </li>
								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">

									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<form action="#" method="post" id="form-fl">
											<div class="col-xxs-12 col-xs-6 mt">

												<div class="input-field">
													<label for="from">dari</label>
													<select name="d" class="form-control select2 f14Bold" id="cbo_from">
														<?php
															foreach ($airports as $airport){
																if ($airport->country_id != 'id') {
																	$sel = '<option value="'.$airport->airport_code. '" ' .(strcmp($airport->airport_code, $s_origin)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).', '.trim($airport->country_name).')</option>"';
																} else {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_origin)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).')</option>"';
																}
																echo $sel;
															}
														?>

													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt">

												<div class="input-field">

													<label for="from">ke:</label>
													<select name="a" class="form-control select2 f14Bold" id="cbo_to">

														<?php
															foreach ($airports as $airport){
																if ($airport->country_id != 'id') {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_arrival)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).', '.trim($airport->country_name).')</option>"';
																} else {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_arrival)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).')</option>"';
																}
																echo $sel;
															}
														?>
													</select>

												</div>
											</div>

									<div class="row no-margin">
										<div class="col-xxs-12 mt alternate no-padding">

											<div class="col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start" class="lableFont">BERANGKAT:</label>
													<div class="input-group">
								                      <input type="text" name="departure_date" data-date-format="yyyy-mm-dd"  class="form-control"  id="date-start" placeholder="mm/dd/yyyy"/ value="<?php echo (strcmp($s_date, '')==0) ? date('Y-m-d', strtotime('+1 days')) : $s_date; ?>">
								                      <div class="input-group-addon">
								                        <i class="icon-calendar"></i>
								                      </div>
								                    </div>
												</div>
											</div>

										</div>
									</div>


									<div class="row mt no-margin">

										<div class="col-xxs-12 mt alternate no-padding">
											<div class="col-xs-12 alternate">
												<label for="class" class="lableFont">PENUMPANG:</label>

												<div class="row">

												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border" name="adult" id="adult">

															<option value="1" selected>1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>

														<div class="input-group-addon">
									                        <img src="images/Asset/iconAdult.png" style="height: 25px;" class="">
									                     </div>
								                     </div>
												</div>

												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border" name="child" id="child">
															<option value="" disabled selected>0</option>
															<option value="0">0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>
														<div class="input-group-addon">
									                        <img src="images/Asset/iconChild.png" style="height: 25px;" class="">
									                     </div>
								                     </div>
												</div>


												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border" name="children" id="children">
															<option value="" disabled selected>0</option>
															<option value="0">0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>
														<div class="input-group-addon">
										                    <img src="images/Asset/iconBaby.png" style="height: 25px;" class="">
										                </div>
								                     </div>
												</div>
												</div>
											</div>
										</div>
									</div>



											<div class="col-xs-12 top20" style="padding: 0 15%;">
												<input  type="submit" class="btn btn-primary btn-block" value="CARI TIKET">
											</div>
										</form>
										</div>
									 </div>


									 <div role="tabpanel" class="tab-pane" id="hotels">

									 	<div class="row">
											<form action="#" method="post" id="form-pp">
											<div class="col-xxs-12 col-xs-6 mt">

												<label for="from">Dari:</label>
												<div class="input-field">

													<select name="d" class="form-control select2 f14Bold" id="cbo_from_pp">
														<?php
															foreach ($airports as $airport){
																if ($airport->country_id != 'id') {
																	$sel = '<option value="'.$airport->airport_code. '" ' .(strcmp($airport->airport_code, $s_origin)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).', '.trim($airport->country_name).')</option>"';
																} else {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_origin)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).')</option>"';
																}
																echo $sel;
															}
														?>
													</select>
												</div>
											</div>

											<div class="col-xxs-12 col-xs-6 mt">
												<div class="input-field">
												<label for="from">Ke:</label>
													<select name="a" class="form-control select2 f14Bold" id="cbo_to_pp">
														<?php
															foreach ($airports as $airport){
																if ($airport->country_id != 'id') {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_arrival)==0 ? 'selected' :  ''). ' >'.trim($airport->location_name).' ('.trim($airport->airport_name).', '.trim($airport->country_name).')</option>"';
																} else {
																	$sel = '<option value="'.$airport->airport_code.'" ' .(strcmp($airport->airport_code, $s_arrival)==0 ? 'selected' : ''). ' >'.trim($airport->location_name).' ('.trim($airport->air).')</option>"';
																}
																echo $sel;
															}
														?>
													</select>
												</div>
											</div>

									<div class="row no-margin">
										<div class="col-xxs-12 mt alternate no-padding">

											<div class="col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start" class="lableFont">BERANGKAT:</label>
													<div class="input-group">
								                      <input type="text" class="form-control"  name="departure_date_pp" id="date-start" data-date-format="yyyy-mm-dd" placeholder="mm/dd/yyyy" value="<?php echo (strcmp($s_date, '')==0) ? date('Y-m-d', strtotime('+1 days')) : $s_date; ?>"/>
								                      <div class="input-group-addon">
								                        <i class="icon-calendar"></i>
								                      </div>
								                    </div>
												</div>
											</div>

											<div class="col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end" class="lableFont">KEMBALI:</label>
													<div class="input-group">
								                      <input type="text" class="form-control" name="return_date" id="date-end" data-date-format="yyyy-mm-dd" placeholder="mm/dd/yyyy"/ value="<?php echo (strcmp($s_date, '')==0) ? date('Y-m-d', strtotime('+3 days')) : $s_date; ?>">
								                      <div class="input-group-addon">
								                        <i class="icon-calendar"></i>
								                      </div>
								                    </div>
												</div>
											</div>
										</div>
									</div>


									<div class="row mt no-margin">

										<div class="col-xs-12 alternate">
												<label for="class" class="lableFont">PENUMPANG:</label>

												<div class="row">

												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border" name="adult" id="adult_pp">
															<option value="" disabled selected>0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>

														<div class="input-group-addon">
									                        <img src="images/Asset/iconAdult.png" style="height: 25px;" class="">
									                     </div>
								                     </div>
												</div>

												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border" name="child" id="child_pp">
															<option value="" disabled selected>0</option>
															<option value="0">0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>
														<div class="input-group-addon">
									                        <img src="images/Asset/iconChild.png" style="height: 25px;" class="">
									                     </div>
								                     </div>
												</div>


												<div class="col-xs-4 alternate">
													<div class="input-group">
														<select class="cs-select cs-skin-border">
															<option value="" disabled selected>0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
														</select>
														<div class="input-group-addon">
										                    <img src="images/Asset/iconBaby.png" style="height: 25px;" class="">
										                </div>
								                     </div>
												</div>
												</div>
											</div>
									</div>



											<div class="col-xs-12 top20" style="padding: 0 15%;">
												<input  type="submit" class="btn btn-primary btn-block" value="CARI TIKET">
											</div>
										</div>
									 </div>
									 </form>
								</div>

								 <!-- Tab content -->

								</div>
							</div>

							<!-- <div class="desc2 animate-box">
								<div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
									<p>HandCrafted by <a href="http://frehtml5.co/" target="_blank" class="fh5co-site-name">FreeHTML5.co</a></p>
									<h2>Exclusive Limited Time Offer</h2>
									<h3>Fly to Hong Kong via Los Angeles, USA</h3>
									<span class="price">$599</span>
									 <p><a class="btn btn-primary btn-lg" href="#">Get Started</a></p>
								</div>
							</div>  -->

						</div>
					</div>
		</div>


	<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>

	<!-- Main JS -->
	<script src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script src="js/jquery.redirect.js"></script>

	<script>
		$(document).ready(function(){

			$(".select2").select2({
                placeholder: "",
                //allowClear: true
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			$('.datepicker').on('changeDate', function(ev){
			 	$(this).datepicker('hide');
			});


			$("#cbo_from").select2({
                placeholder: "",
                //allowClear: true
			});
			$("#cbo_to").select2({
				placeholder: "",
				//allowClear: true
			});
			$('#return-div').hide();
			$('#round-trip').change(function () {
				if($('#round-trip').is(':checked')) {
					$('#return-div').show("slow");
				} else {
					$('#return-div').hide("slow");
				}
			});

			function postData(actionUrl, method, data) {
				var mapForm = $('<form id="mapform" action="' + actionUrl + '" method="' + method.toLowerCase() + '"></form>');
				for (var key in data) {
					if (data.hasOwnProperty(key)) {
						mapForm.append('<input type="hidden" name="' + key + '" id="' + key + '" value="' + data[key] + '" />');
					}
				}
				$('body').append(mapForm);
				mapForm.submit();
			}

			// $('#loader').hide();
			$('#form-fl').submit(function(e) {
				e.preventDefault();
				$('#loading-modal').modal({
					keyboard: false,
					backdrop: "static"
				});

				// send to php

				var data = JSON.stringify({ "origin": $("#cbo_from").find(":selected").val(),
					"destination" : $("#cbo_to").find(":selected").val(),
					"adult" : $("#adult").find(":selected").val(),
					"child" : $("#child	").find(":selected").val(),
					"infant" : 0,
					"departure_date" : $("input[name=departure_date]").val(),
					// "return_date" : $("input[name=return_date]").val(),
					"airline" : "citilink",
					"flight_time" : "",
					"transit" : 0,
					"roundtrip" : $("input[name=roundtrip]").val(),
					"tiket_token" : "<?php echo $token; ?>"
				});

				//alert(data);

				var jqxhr = $.post( "flight-process.php", data, function(data) {
					// alert( "success" );
					// alert(JSON.stringify(data));
					console.log(data);
					$.redirect('resultnew.php', {'formdata' : JSON.stringify(data)});
					// $.postdatas({
					// 	url:'flight-result-bj.php',
					// 	datas:data
					// });
					// postData('flight-result-bj.php', 'post', data);
				})
				.fail(function(e) {
					// alert("error");
					// alert(JSON.stringify(e));
					console.log(data);
				})
				.always(function() {
					$('#loading-modal').modal('hide');
				});

			});

		});
	</script>
	<script>
		$(document).ready(function(){
			$('.datepicker').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});


			$("#cbo_from").select2({
								placeholder: "",
								//allowClear: true
			});
			$("#cbo_to").select2({
				placeholder: "",
				//allowClear: true
			});
			$('#return-div').hide();
			$('#round-trip').change(function () {
				if($('#round-trip').is(':checked')) {
					$('#return-div').show("slow");
				} else {
					$('#return-div').hide("slow");
				}
			});

			function postData(actionUrl, method, data) {
				var mapForm = $('<form id="mapform" action="' + actionUrl + '" method="' + method.toLowerCase() + '"></form>');
				for (var key in data) {
					if (data.hasOwnProperty(key)) {
						mapForm.append('<input type="hidden" name="' + key + '" id="' + key + '" value="' + data[key] + '" />');
					}
				}
				$('body').append(mapForm);
				mapForm.submit();
			}

			// $('#loader').hide();
			$('#form-pp').submit(function(e) {
				e.preventDefault();
				$('#loading-modal').modal({
					keyboard: false,
					backdrop: "static"
				});

				// send to php

				var data = JSON.stringify({ "origin": $("#cbo_from_pp").find(":selected").val(),
					"destination" : $("#cbo_to_pp").find(":selected").val(),
					"adult" : $("#adult_pp").find(":selected").val(),
					"child" : $("#child_pp").find(":selected").val(),
					"infant" : 0,
					"departure_date" : $("input[name=departure_date_pp]").val(),
					"return_date" : $("input[name=return_date]").val(),
					"airline" : "",
					"flight_time" : "",
					"transit" : 0,
					"roundtrip" : 1,
					"tiket_token" : "<?php echo $token; ?>"
				});

				console.log(data);



				var jqxhr = $.post( "flight-process-pp.php", data, function(data) {
					// alert( "success" );
					// alert(JSON.stringify(data));
					console.log(data);
					console.log(data.results);
					$.redirect('result_pp.php', {'formdata' : JSON.stringify(data)});
					// $.postdatas({
					// 	url:'flight-result-bj.php',
					// 	datas:data
					// });
					// postData('flight-result-bj.php', 'post', data);
				})
				.fail(function(e) {
					// alert("error");
					// alert(JSON.stringify(e));
					console.log(data);
				})
				.always(function() {
					$('#loading-modal').modal('hide');
				});

			});

		});
	</script>


	</body>
</html>

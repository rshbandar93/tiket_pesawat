

<?php
	session_start();
	if (!function_exists("curl_init")) die("cURL extension is not installed");

	$formdata = $_POST['formdata'];
	$formdata = json_decode($formdata);
	$formdata = json_encode($formdata);
	$formdata = json_decode($formdata);

	// print_r($formdata);

	// echo json_decode($formdata);

	// header("Access-Control-Allow-Origin: *");
	// header("Content-Type: application/json; charset=UTF-8");

	// $undecode_json = file_get_contents('php://input');
	// $json = json_decode($undecode_json);

	// echo json_encode($json);
	// echo file_get_contents('php://input');;
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

	<!-- <link rel="stylesheet" href="plugins/rangeslider/rangeslider.css"> -->

	<link rel="stylesheet" href="plugins/iCheck/all.css">
	<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body  style="background-color: #7798c5;">
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
					<div class="titleText">PENERBANGAN</div>
					<div class="center gray"><?php echo $formdata->origin_name; ?> - <?php echo $formdata->destination_name; ?> <br><?php echo $formdata->departure_date_formatted; ?></p></div>
					<div class="row no-padding marginT">
						<!--<span class="dateGo gray" style="font-size: 10px; float: left;">2 adult  |  Economy</span>-->
						<span class="dateGo gray" style="font-size: 10px; float: right;"><?php echo $formdata->departure_date_formatted; ?></span>
					</div>
				</div>
			</div>
		</header>

		<!-- end:header-top -->

		<div class="">
			<div class="row filterBox no-margin">
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#MASKAPAI">MASKAPAI</button></div>
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#WAKTU">WAKTU</button></div>
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#TRANSIT">TRANSIT</button></div>
			</div>

<!--maskapai-->
			<div id="MASKAPAI" class="collapse filterCollapse">
				<div class="row filterBox no-margin">
					<div class="col-xs-8" style="text-align: left; padding: 2px 0;">MASKAPAI</div>
					<div id="btnmaskapai" class="col-xs-4" style="padding: 0;"><button style="float: right;" class="btn btn-primary btnPad" data-toggle="collapse" data-target="#MASKAPAI">DONE</button></div>
				</div>
				<div class="form-group" style="padding:0 15px;">
					<div style="border-bottom:2px solid #d2cece; padding-top:10px; padding-bottom:5px;">
						<span class="selectAll">SELECT ALL</span>
						<span class="clearAll">CLEAR ALL</span>
					</div>


					<div Class="listBox">
						<span class="bold f14" style="float:left;">Air Asia</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Asia" value="Air Asia" class="checkmaskapai" checked />
							    <label for="Asia"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Batik Air</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Batik" value="Batik Air" class="checkmaskapai" checked />
							    <label for="Batik"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Citilink</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Citilink" value="Citilink" class="checkmaskapai" checked />
							    <label for="Citilink"></label>
							</label>
	                    </span>
                  	</div>


                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Garuda Indonesia</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Garuda" value="Garuda Indonesia" class="checkmaskapai" checked />
							    <label for="Garuda"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Lion Air</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Lion" value="Lion Air" class="checkmaskapai" checked />
							    <label for="Lion"></label>
							</label>
	                    </span>
                  	</div>

					<div Class="listBox">
						<span class="bold f14" style="float:left;">Sriwijaya Air</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Sri" value="Sriwijaya Air" class="checkmaskapai" checked />
							    <label for="Sriwijaya"></label>
							</label>
	                    </span>
                  	</div>

                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Malaysia Airlines</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox"  id="Malaysia" value="Malaysia Airlines" class="checkmaskapai"  checked />
							    <label for="Malaysia"></label>
							</label>
	                    </span>
                  	</div>

				</div>
			</div>

			<div id="WAKTU" class="collapse filterCollapse">
				<div class="row filterBox no-margin">
					<div class="col-xs-8" style="text-align: left; padding: 2px 0;">WAKTU</div>
					<div id="btnwaktu" class="col-xs-4" style="padding: 0;"><button style="float: right;" class="btn btn-primary btnPad" data-toggle="collapse" data-target="#WAKTU">DONE</button></div>
				</div>


				<div class="form-group" style="padding:0 15px;">
					<div style="border-bottom:1.5px solid #999999; padding-top:5px; padding-bottom:5px;">
						<span class="clearAll" style="padding:0;">DEPARTURE TIMES</span>
					</div>

					<div style="padding:10px 0">
						<div style="font-size:14px; color:#000000">Outbond</div>
						<div class="time1" style="font-size:12px;">00:00 - 23:59</div>
						<input id="ex1" type="text" class="span2" value="" data-slider-min="0" data-slider-max="1440" data-slider-step="2" data-slider-value="[0,1440]"/>
					</div>


					<!--<div style="padding:10px 0">
						<div style="font-size:14px; color:#000000">Return</div>
						<div class="time2" style="font-size:12px;">00:00 - 23:59</div>
						<input id="ex2" type="text" class="span2" value="" data-slider-min="100" data-slider-max="2400" data-slider-step="100" data-slider-value="[0,2300]"/>
					</div> -->
				</div>
			</div>

			<div id="TRANSIT" class="collapse filterCollapse">
				<div class="row filterBox no-margin">
					<div class="col-xs-8" style="text-align: left; padding: 2px 0;">TRANSIT</div>
					<div class="col-xs-4" style="padding: 0;"><button style="float: right;" class="btn btn-primary btnPad" data-toggle="collapse" data-target="#TRANSIT">DONE</button></div>
				</div>

				<div class="form-group" style="padding:0 15px;">
					<div style="border-bottom:1.5px solid #999999; padding-top:5px; padding-bottom:5px;">
						<span class="clearAll" style="padding:0;">STOPS</span>
					</div>


					<div Class="listBox">
						<span class="bold f14" style="float:left;">Direct</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Malaysia" name="Malaysia" checked />
							    <label for="Malaysia"></label>
							</label>
	                    </span>
                  	</div>


                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">1 Stop</span>
						<span class="f14" style="float:right;">

							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Malaysia" name="Malaysia" checked />
							    <label for="Malaysia"></label>
							</label>
	                    </span>
                  	</div>

				 	<div Class="listBox">
						<span class="bold f14" style="float:left;">2x Stop</span>
						<span style="float:right;">
							None
	                    </span>
                  	</div>
				</div>

			</div>




			<!-- Nav tabs -->
				<ul class="nav nav-tabs resultHead" role="tablist">
					<li role="presentation" style="width: 30%; text-align: center; float:left;">
						<div style="padding:6px 0;">RESULT FROM:</div>
					</li>


					<li role="presentation" class="active" style="width: 35%; text-align: center;">
						<a class="skyscanner" href="#Skyscanner" aria-controls="flights" role="tab" data-toggle="tab" style="background-color: #fff !important; color: rgba(255, 255, 255, 0) !important;">
							Skyscanner
						</a>
					</li>
					<li role="presentation" style="width: 35%; text-align: center; float:right;">
						<!--<a class="tiketCom" href="#tiketCom" aria-controls="hotels" role="tab" data-toggle="tab" style="background-color: #fff !important; color: rgba(255, 255, 255, 0) !important;">-->
						<!--<<a class="tiketCom" href="" aria-controls="hotels" role="tab" data-toggle="tab" style="background-color: #fff !important; color: rgba(255, 255, 255, 0) !important;">
							Tiket-->
						</a>
					</li>
				</ul>


			<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div class="tabulation animate-box">

								<!-- Tab panes -->
								<div class="tab-content" style="padding: 10px;">
									 <div role="tabpanel" class="tab-pane active" id="Skyscanner">
										<div class="row">
											<?php foreach ($formdata->results as $row) { ?>
										<div class="col-xs-12 whiteBox">

										<div class="col-xxs-12 col-xs-8">



											<div class="listBox">
												<img src="<?php echo $row->departure->image; ?>" style="height:auto; width: 70px; float: left;">

												<div style="width:calc(100% - 70px); float: left;">
													<div class="col-xs-3 depart">
														<span class="times"><?php echo substr($row->departure->full_via,11,6); ?></span>
														<span class="stop-station" data-id="10485"><?php echo substr($row->departure->full_via,0,3); ?></span>
													</div>

													<div class="col-xs-6 stopBox">
														<div class="stops">
															<span class="duration"><?php echo $row->departure->duration; ?></span>

															<ul class="stop-line">
																<img class="chevright" src="images/Asset/cheright.png">
															</ul>

															<div class="leg-stops">
																<span class="leg-stops-red leg-stops-label">DIRECT</span>
															</div>
														</div>
													</div>
													<div class="col-xs-3 arrive">
														<span class="times"><?php echo substr($row->departure->full_via,19,5); ?></span>
														<span class="stop-station" data-id="10485"><?php echo substr($row->departure->full_via,6,3); ?></span>
													</div>
												</div>
											</div>
										</div>

											<div class="col-xxs-12 col-xs-4 padOrder">
												<div class="col-xs-7 col-md-12 col-sm-12 no-padding price">Rp.<?php echo number_format(intval($row->total_price),0,',','.') ?></div>
												<div class="col-xs-5 col-md-12 col-sm-12 no-padding">
													<input onClick="window.location.href='<?php echo $row->departure->deepLink; ?>'" type="submit" class="btn btn-primary btn-block btnResultOrder" value="PESAN">
												</div>
											</div>
										</div>
										<?php } ?>
										</div>

										<!--skyscanner -->
									 </div>







									 <div role="tabpanel" class="tab-pane" id="tiketCom">
									 	<div class="row">
									 		<div class="col-xs-12 no-padding">
									 			<div class="col-xs-6" style="padding: 2px !important;">
									 				<div class="headResult">PERGI</div>
									 		<div class="resultBox" >
												<img src="images/Asset/lionTiket.png" style="height:auto; width: 70px; text-align:center;">

												<div style="width:100%; float: left; border-bottom: 1px solid #e0dcdc; padding-bottom: 5px;">
													<div class="col-xs-3 depart2">
														<span class="times2">08.30</span>
														<span class="stop-station2" data-id="10485">CGK</span>
													</div>

													<div class="col-xs-6 stopBox2">
														<div class="stops">
															<ul class="stop-line">
																<img class="chevright" src="images/Asset/cheright.png">
															</ul>

															<div class="leg-stops">
																<span class="leg-stops-red leg-stops-label">DIRECT</span>
															</div>
														</div>
													</div>

													<div class="col-xs-3 arrive2">
														<span class="times2">08.30</span>
														<span class="stop-station2" data-id="10485">CGK</span>
													</div>
												</div>

												<div style="width: 100%; padding-top: 10px; display: inline-block;">
													<div class="col-xs-6 no-padding price2">Rp.342.242/org</div>
													<div class="col-xs-6 no-padding">
														<input style="padding: 2px 5px; font-size: 10px; width: 70%; float: right;" type="submit" class="btn btn-primary btn-block" value="PESAN">
													</div>
												</div>
											</div>

									 			</div>

									 			<div class="col-xs-6" style="padding: 2px !important;">
									 				<div class="headResult">PULANG</div>

									 				<div class="resultBox" >
												<img src="images/Asset/lionTiket.png" style="height:auto; width: 70px; text-align:center;">

												<div style="width:100%; float: left; border-bottom: 1px solid #e0dcdc; padding-bottom: 5px;">
													<div class="col-xs-3 depart2">
														<span class="times2">08.30</span>
														<span class="stop-station2" data-id="10485">CGK</span>
													</div>

													<div class="col-xs-6 stopBox2">
														<div class="stops">
															<ul class="stop-line">
																<img class="chevright" src="images/Asset/cheright.png">
															</ul>

															<div class="leg-stops">
																<span class="leg-stops-red leg-stops-label">DIRECT</span>
															</div>
														</div>
													</div>

													<div class="col-xs-3 arrive2">
														<span class="times2">08.30</span>
														<span class="stop-station2" data-id="10485">CGK</span>
													</div>
												</div>

												<div style="width: 100%; padding-top: 10px; display: inline-block;">
													<div class="col-xs-6 no-padding price2">Rp.342.242/org</div>
													<div class="col-xs-6 no-padding">
														<input style="padding: 2px 5px; font-size: 10px; width: 70%; float: right;" type="submit" class="btn btn-primary btn-block" value="PESAN">
													</div>
												</div>
											</div>

									 			</div>

									 		</div>


										</div>
									 </div>
								</div> <!-- Tab content -->

								</div>
							</div>


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

	<!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/iCheck/icheck.js"></script>

    <script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
    <!-- <script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>  -->

    <script src="plugins/rangeslider/rangeslider.js"></script>

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

			// // With JQuery
			// $('#ex1').slider({
			// 	formatter: function(value) {
			// 		return 'Current value: ' + value;
			// 	}
			// });
			//
			// // Without JQuery
			// var slider = new Slider('#ex1', {
			// 	formatter: function(value) {
			// 		return 'Current value: ' + value;
			// 	}
			// });
			//
			//
			// // With JQuery
			$("#ex1").slider({});
			function number_to_time(val){
				var min_num = val; // don't forget the second param
				var hours   = Math.floor(min_num / 60);
				var minutes = Math.floor(min_num - (hours * 60)) ;
				if (hours   < 10) {hours   = "0"+hours;}
				if (minutes < 10) {minutes = "0"+minutes;}
				return hours+':'+minutes
			};
			var data = JSON.stringify(<?php echo $formdata->json_input ; ?>);
			$('#ex1').on('slide', function(slider){
				var timeone = number_to_time(slider.value[0]);
				var timetwo = number_to_time(slider.value[1]);
				$(".time1").html(timeone + " - " + timetwo);
			});
			$('#btnwaktu').click(function(e){
				e.preventDefault();
				$('#loading-modal').modal({
					keyboard: false,
					backdrop: "static"
				});
				var data_json = $.parseJSON(data);
				var time = $('#ex1').data('slider').getValue();
				data_json['timeone'] = number_to_time(time[0]);
				data_json['timetwo'] = number_to_time(time[1]);
				var jdata = JSON.stringify(data_json);
				var jqxhr = $.post( "flight-process.php", jdata, function(jdata) {
					$.redirect('resultnew.php', {'formdata' : JSON.stringify(jdata)});
				})
			});
			$('#btnmaskapai').click(function(e){
				e.preventDefault();
				$('#loading-modal').modal({
					keyboard: false,
					backdrop: "static"
				});
				var data_json = $.parseJSON(data);
				var maskapai = [];
            	$.each($(".checkmaskapai:checked"), function(){
                	maskapai.push($(this).val());
            	});
				data_json['maskapai_filter'] = maskapai;
				var jdata = JSON.stringify(data_json);
				var jqxhr = $.post( "flight-process.php", jdata, function(jdata) {
					$.redirect('resultnew.php', {'formdata' : JSON.stringify(jdata)});
				})
				console.log(maskapai);
			});
			//
			// // Without JQuery
			// var slider = new Slider('#ex2', {});

		});


	</script>


	<!-- <script src="jquery.min.js"></script> -->
<!-- <script src="plugins/rangeslider/rangeslider.min.js"></script> -->
<!-- <script>
    // Initialize a new plugin instance for all
    // e.g. $('input[type="range"]') elements.
    $('input[type="range"]').rangeslider();

    // Destroy all plugin instances created from the
    // e.g. $('input[type="range"]') elements.
    $('input[type="range"]').rangeslider('destroy');

    // Update all rangeslider instances for all
    // e.g. $('input[type="range"]') elements.
    // Usefull if you changed some attributes e.g. `min` or `max` etc.
    $('input[type="range"]').rangeslider('update', true);
</script> -->

<script>
		$(document).ready(function(){
			$("#cbo_from").select2({
				placeholder: "From",
				//allowClear: true
			});
			$("#cbo_to").select2({
				placeholder: "To",
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

			$('#form-fl').submit(function(e) {
				e.preventDefault();
				alert('ooi');
			});

		});

		$()

		</script>



	</body>
</html>

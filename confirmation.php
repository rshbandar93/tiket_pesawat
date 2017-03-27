



<?php

$id_pesan = (isset($_GET['idpnb'])?$_GET['idpnb']:'');
$Token = (isset($_GET['token'])?$_GET['token']:'');

//$Secret		= 'a2d4c49553532e84867c1b07be914f97'; //Zainal

//$TokenJSON=json_decode(file_get_contents($GetToken), true);
//$Status=$TokenJSON['diagnostic']['status'];
//if ($Status!='403'){
//	$Token=$TokenJSON['token'];
//}

?>
<?php
print_r($Token);

?>

<?php
 $url = "https://api.tiket.com/flight_api/get_flight_data?flight_id=".$id_pesan."&token=".$Token."&output=json";
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);

 //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
 //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 $r = curl_exec($ch);
 if($errno = curl_errno($ch)) {
		 $error_message = curl_strerror($errno);
		 echo "cURL error ({$errno}):\n {$error_message}";
 }
 curl_close($ch);

 $list_tiket = json_decode($r);



$token = $list_tiket->token;
$list_tikets = $list_tiket->departures;
$penumpang = $list_tiket->required->separator->mandatory;
//$origin_name = $list_tiket->go_det->dep_airport->business_name;
//$destination_name = $list_tiket->go_det->arr_airport->business_name;
//$departure_date_formatted = $list_tiket->go_det->formatted_date;
//print_r($token);
print_r($penumpang);



$_SESSION["token"] = "$Token";





 ?>
<?php

;
 ?>

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
		<header class="navHead">
			<div class="container">
				<div style="width:85px; float: left;">
					<img src="images/Asset/bangJoni.png" class="" style="height:auto; width: 80px;">
				</div>

				<div class="textBox">
					<span><img src="images/Asset/chevron.png" class="dialog"></span>

					Coba cek lagi ringkasan pemesanan tiket pesawat yang kamu pilih.
				</div>
			</div>
		</header>

		<!-- end:header-top -->
<!--
		<div class="">
			<div class="row filterBox no-margin">
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#MASKAPAI">MASKAPAI</button></div>
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#WAKTU">WAKTU</button></div>
				<div class="col-xs-4"><button class="btnBlank" data-toggle="collapse" data-target="#TRANSIT">TRANSIT</button></div>
			</div>

			<div id="MASKAPAI" class="collapse filterCollapse">
				<div class="row filterBox no-margin">
					<div class="col-xs-8" style="text-align: left; padding: 2px 0;">MASKAPAI</div>
					<div class="col-xs-4" style="padding: 0;"><button style="float: right;" class="btn btn-primary btnPad" data-toggle="collapse" data-target="#MASKAPAI">DONE</button></div>
				</div>
				<div class="form-group" style="padding:0 15px;">
					<div style="border-bottom:2px solid #d2cece; padding-top:10px; padding-bottom:5px;">
						<span class="selectAll">SELECT ALL</span>
						<span class="clearAll">CLEAR ALL</span>
					</div>


					<div Class="listBox">
						<span class="bold f14" style="float:left;">Air Asia</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Asia" name="check" checked />
							    <label for="Asia"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Batik Air</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Batik" name="Batik" checked />
							    <label for="Batik"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Citilink</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Citilink" name="Citilink" checked />
							    <label for="Citilink"></label>
							</label>
	                    </span>
                  	</div>


                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Garuda Indonesia</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Garuda" name="Garuda" checked />
							    <label for="Garuda"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Lion Air</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Lion" name="Lion" checked />
							    <label for="Lion"></label>
							</label>
	                    </span>
                  	</div>



                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">Malaysia Airlines</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Malaysia" name="Malaysia" checked />
							    <label for="Malaysia"></label>
							</label>
	                    </span>
                  	</div>

				</div>
			</div>

			<div id="WAKTU" class="collapse filterCollapse">
				<div class="row filterBox no-margin">
					<div class="col-xs-8" style="text-align: left; padding: 2px 0;">WAKTU</div>
					<div class="col-xs-4" style="padding: 0;"><button style="float: right;" class="btn btn-primary btnPad" data-toggle="collapse" data-target="#WAKTU">DONE</button></div>
				</div>


				<div class="form-group" style="padding:0 15px;">
					<div style="border-bottom:1.5px solid #999999; padding-top:5px; padding-bottom:5px;">
						<span class="clearAll" style="padding:0;">DEPARTURE TIMES</span>
					</div>

					<div style="padding:10px 0">
						<div style="font-size:14px; color:#000000">Outbond</div>
						<div style="font-size:12px;">00:00 - 23:59</div>
						<input id="ex1" type="text" class="span2" value="" data-slider-min="100" data-slider-max="2400" data-slider-step="100" data-slider-value="[0,2300]"/>
					</div>


					<div style="padding:10px 0">
						<div style="font-size:14px; color:#000000">Return</div>
						<div style="font-size:12px;">00:00 - 23:59</div>
						<input id="ex2" type="text" class="span2" value="" data-slider-min="100" data-slider-max="2400" data-slider-step="100" data-slider-value="[0,2300]"/>
					</div>
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
							 IDR 500.000
							<label class="squaredFour">
							    <input type="checkbox" value="None" id="Malaysia" name="Malaysia" checked />
							    <label for="Malaysia"></label>
							</label>
	                    </span>
                  	</div>


                  	<div Class="listBox">
						<span class="bold f14" style="float:left;">1 Stop</span>
						<span class="f14" style="float:right;">
							 IDR 500.000
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
		</div>

	-->

		<div class="row no-margin">
			<div class="col-xs-12" style="background-color:#fff; padding:10px 15px; margin-bottom:5px;">
				<div style="font-size: 14px; line-height: 14px; color: #326699; font-weight: bold; border-bottom: 1.5px solid #999999; padding: 5px 0;">
				PENERBANGAN PERGI </br> <span style="font-size: 10px; color: #a5a5a5;"><?php echo $list_tikets->departure_flight_date_str; ?></span>
				</div>

				<div>
					<img src="<?php echo $list_tikets->image; ?>" style="height: 20px; margin: 10px 0;">
				</div>

				<div style="width: 100%; float: left; border-bottom: 1px solid #999999; padding-bottom: 5px;">
					<div class="col-xs-5 arrive" style="padding: 0 !important;">
						<div class="timesConfirm"><?php echo substr($list_tikets->full_via,11,6); ?></div>
						<div class="timesConfirm" data-id="10485"> <?php echo substr($list_tikets->full_via,0,3); ?></div>
						<div style="font-size:9px;"><?php echo $list_tikets->departure_flight_date_str; ?></div>
					</div>

					<div class="col-xs-2 stopBox" style="padding: 5px !Important; font-size: 8px;">
						<div class="stops">
							<ul class="stop-line">
								<img class="directArrow" src="images/Asset/cheright.png">
							</ul>

							<div class="leg-stops">
								<span class="leg-stops-red leg-stops-label"><?php echo $list_tikets->stop; ?></span>
							</div>
						</div>
					</div>
					<div class="col-xs-5 arrive" style="padding: 0 10px !important;">
						<div class="timesConfirm"><?php echo substr($list_tikets->full_via,19,5); ?></div>
						<div class="timesConfirm" data-id="10485"><?php echo substr($list_tikets->full_via,6,3); ?></div>
						<div style="font-size:9px;"><?php echo $list_tikets->arrival_flight_date_str; ?></div>
					</div>
				</div>

				<div style="width:100%; float: left; padding-top: 10px; color:#efbd03;">
					<span style="text-align:left; font-size:10px; font-weight: bold;">HARGA</span>
					<span style="text-align:right; float:right; font-weight:bold; font-size:14px;">Rp.<?php echo number_format(intval($list_tikets->price_value),0,',','.') ?></span>
				</div>

			</div>





			<div class="col-xs-12 totalBox" style="font-size: 14px; color: #efbd03;">
				TOTAL : <span> Rp.<?php echo number_format(intval($list_tikets->price_value),0,',','.') ?></span>
			</div>


			<div class="col-xs-12" style="text-align:center; width:100%;">
				<button onClick="window.location.href='order-form.php?idpnb=<?php echo $id_pesan; ?>&token=<?php echo $Token; ?>'" style="margin: 20px auto; padding: 5px; font-size: 14px; width: 70%;" type="submit" class="btn btn-primary btn-block" value="PESAN">PESAN </button>
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
			$("#ex2").slider({});
			//
			// // Without JQuery
			// var slider = new Slider('#ex2', {});

		});


	</script>

	</body>
</html>

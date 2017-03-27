
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
$id_pesan = (isset($_GET['idpnb'])?$_GET['idpnb']:'');
$Token = (isset($_GET['token'])?$_GET['token']:'');

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

	<link rel="stylesheet" href="plugins/iCheck/all.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body  style="background-color: #326699;">
		<header class="navHead">
			<div class="container">
				<div style="width:85px; float: left;">
					<img src="images/Asset/bangJoni.png" class="" style="height:auto; width: 80px;">
				</div>

				<div class="textBox">
					<span><img src="images/Asset/chevron.png" class="dialog"></span>

					One step away to ordering your ticket. Tinggal isi data kamu yang lengkap nih!
				</div>
			</div>
		</header>


		<div class="" style="text-align:left;">
			<div class="row filterBox no-margin" style="text-align:left;">
				INFORMASI KONTAK YANG DAPAT DIHUBUNGI
			</div>
		</div>


		<div class="container animate-box" style="background-color: #7798c5;">
			<div class="row mt no-margin animate-box">
				<div class="col-xs-4 mt alternate no-padding" style="padding-right: 10px !important;">
					<label for="class" class="lableFont">TITEL:</label>
					<select class="cs-select cs-skin-border">
						<option value="" disabled selected>TUAN</option>
						<option value="NYONYA">NYONYA</option>
						<option value="AGAN">AGAN</option>
					</select>
				</div>

				<div class="col-xs-8 mt alternate no-padding">
					<label for="class" class="lableFont">NAMA LENGKAP:</label>
					<input type="text" class="form-control noRadius" id="from-place" placeholder="ISI SESUAI KTP/SIM/PASPOR" style="padding: 10px;">
				</div>
			</div>


			<div class="row mt no-margin animate-box">
				<label for="class" class="lableFont">NO. TELEPON:</label>
				<div class="row no-margin">
					<div class="col-xs-3 mt alternate no-padding" style="padding-right: 10px !important;">
						<input type="text" class="form-control noRadius" id="from-place" placeholder="621" style="padding: 10px;" readonly>
					</div>

					<div class="col-xs-9 mt alternate no-padding">
						<input type="text" class="form-control noRadius" id="from-place" placeholder="" style="padding: 10px;">
					</div>
				</div>
			</div>
		</div>


		<div class="container animate-box">
			<?php echo $list_tiket->departures->count_adult; ?>
			<?php
for ($x = 1; $x <= $list_tiket->departures->count_adult; $x++) {


?>



			<div class="headList">DETAIL PENUMPANG <?php echo $x; ?> </div>

			<span class="f14">
				<label class="squaredFourWhite">
					<input type="checkbox" value="None" id="same" name="same"/>
					<label for="same"></label>
				</label>
				<label class="f12 labelCheck">SAMA DENGAN KONTAK</label>
	        </span>


			<div class="row mt no-margin animate-box">
				<div class="col-xs-4 mt alternate no-padding" style="padding-right: 10px !important;">
					<label for="class" class="lableFont">TITEL:</label>
					<select class="cs-select cs-skin-border">
						<option value="" disabled selected>TUAN</option>
						<option value="NYONYA">NYONYA</option>
						<option value="AGAN">AGAN</option>
					</select>
				</div>

				<div class="col-xs-8 mt alternate no-padding">
					<label for="class" class="lableFont">NAMA LENGKAP:</label>
					<input type="text" class="form-control noRadius" id="from-place" placeholder="ISI SESUAI KTP/SIM/PASPOR" style="padding: 10px;">
				</div>
        <?php } ?>
			</div>



      <?php
for ($y = 1; $y <= $list_tiket->departures->count_child; $y++) {


?>

			<div class="headList">DETAIL PENUMPANG Anak-anak<?php echo $y ?></div>

			<div class="row mt no-margin animate-box">
				<div class="col-xs-4 mt alternate no-padding" style="padding-right: 10px !important;">
					<label for="class" class="lableFont">TITEL:</label>
					<select class="cs-select cs-skin-border">
						<option value="" disabled selected>TUAN</option>
						<option value="NYONYA">NYONYA</option>
						<option value="AGAN">AGAN</option>
					</select>
				</div>

				<div class="col-xs-8 mt alternate no-padding">
					<label for="class" class="lableFont">NAMA LENGKAP:</label>
					<input type="text" class="form-control noRadius" id="from-place" placeholder="ISI SESUAI KTP/SIM/PASPOR" style="padding: 10px;">
				</div>
			</div>
      <?php } ?>


			<div class="col-xs-12" style="text-align:center; width:100%;">
				<button onClick="window.location.href='confirmation.php?idpnb=<?php echo $row->departure->id; ?>&token=<?php echo $formdata->token_tiket; ?>'" style="margin: 20px auto; padding: 5px; font-size: 14px; width: 70%;" type="submit" class="btn btn-primary btn-block" value="PESAN">PESAN </button>
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

    <script src="js/bootstrap-slider.js"></script>

	<!-- Main JS -->
	<script src="js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

	<script>
		$(document).ready(function(){

			$(".select2").select2({
                placeholder: "",
                //allowClear: true
			});

			// With JQuery
			$('#ex1').slider({
				formatter: function(value) {
					return 'Current value: ' + value;
				}
			});

			// Without JQuery
			var slider = new Slider('#ex1', {
				formatter: function(value) {
					return 'Current value: ' + value;
				}
			});


			// With JQuery
			$("#ex2").slider({});

			// Without JQuery
			var slider = new Slider('#ex2', {});

		});


	</script>

	</body>
</html>

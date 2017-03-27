<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  // session_start();

  $undecode_json = file_get_contents('php://input');
  $json = json_decode($undecode_json);

  // print_r($undecode_json);

  $origin = $json->origin;
  $destination = $json->destination;
  $adult = $json->adult;
  $child = $json->child;
  $infant = $json->infant;
  $departure_date = $json->departure_date;
  $departure_date = date_create($json->departure_date);
  $departure_date = date_format($departure_date,"Y-m-d");
  $return_date = 0;
  $airline = $json->airline;
  $flight_time = (int) $json->flight_time;
  $transit = (int) $json->transit;
  $roundtrip = 0;
  if (isset($json->roundtrip)) {
      $roundtrip = $json->roundtrip;
      $return_date = $json->return_date;
  }
  $tiket_token = $json->tiket_token;
	$asal_next = '0';
	$tujuan_next = '0';
  if (isset($json->timeone)){
    $outbond_time_one  = $json->timeone;
    $outbond_time_two  = $json->timetwo;
  } else{
    $outbond_time_one  = '00:00';
    $outbond_time_two  = '23:59';
  }
  if (isset($json->maskapai_filter)){
    $maskapai_filter  = $json->maskapai_filter;
  } else{
    $maskapai_filter  = ["Air Asia", "Batik Air", "Citilink", "Garuda Indonesia", "Lion Air", "Malaysia Airlines", "Sriwijaya Air"];
  }


  if (!function_exists("curl_init")) die("cURL extension is not installed");

  $agent = 'twh:[21060440];[kenzie_tiket];';

  $url = 'http://api.tiket.com/search/flight?d=' . $origin . '&a=' . $destination . '&date=' . $departure_date . '&adult=' . $adult .  '&child=' . $child . '&infant=' . $infant . '&token=' . $tiket_token . '&v=3&output=json';
  // $url = 'http://api.tiket.com/search/flight?d=' . $origin . '&a=' . $destination . '&date=' . $departure_date . '&ret_date=' . $return_date . '&adult=' . $adult .  '&child=' . $child . '&infant=' . $infant . '&token=' . $tiket_token . '&v=3&output=json';
  // print_r($url);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
  curl_setopt($ch, CURLOPT_USERAGENT, $agent);
  //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $r = curl_exec($ch);
  if($errno = curl_errno($ch)) {
      $error_message = curl_strerror($errno);
      echo "cURL error ({$errno}):\n {$error_message}";
  }
  curl_close($ch);

  $list_tiket = json_decode($r);
  // print_r($list_tiket);
  $token = $list_tiket->token;
  $list_tikets = $list_tiket->departures->result;
  $origin_name = $list_tiket->go_det->dep_airport->business_name;
  $destination_name = $list_tiket->go_det->arr_airport->business_name;
  $departure_date_formatted = $list_tiket->go_det->formatted_date;

  $unsorted_result = array();
  $counter = 1;
  foreach ($list_tikets as $tiket) {
    if ($counter > 5) break;
    $result = array(
      'departure' => array(
        'id' => $tiket->flight_id,
        'flight_number' => $tiket->flight_number,
        'full_via'=> $tiket->full_via,
        'image' => $tiket->image,
        'simple_departure_time' => $tiket->simple_departure_time,
        'simple_arrival_time' => $tiket->simple_arrival_time,
        'transit' => $tiket->stop,
        'origin' => $origin,
        'destination' => $destination,
        'duration' => $tiket->duration,
        'price' => $tiket->price_value
      ),
      'total_price' => intval($tiket->price_value),
      'type' => 'tiket.com'
    );
    array_push($unsorted_result, $result);
    $counter++;
  }

  $apikey_sky = 'ba616238434893123338551586683135';
  $url = 'http://partners.api.skyscanner.net/apiservices/pricing/v1.0/?apikey=' . $apikey_sky;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded;  charset=UTF-8','Accept: application/json'));
  curl_setopt($ch, CURLOPT_POSTFIELDS,
         http_build_query(array(
           'currency' => 'IDR',
           'locale' => 'id-ID',
           'originplace' => $origin,
           'destinationplace' => $destination,
           'outbounddate' => $departure_date,
           'adults' => $adult,
           'country' => 'ID',
           'locationschema' => 'Iata',
           'pagesize' => '5',
           'pageindex' => '0',
           'children' => $child
         )));
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  $r = curl_exec($ch);
  if($errno = curl_errno($ch)) {
      $error_message = curl_strerror($errno);
      echo "cURL error ({$errno}):\n {$error_message}";
  }
  $curl_info = curl_getinfo($ch);
  $headers = substr($r, 0, $curl_info["header_size"]);
  preg_match("!\r\n(?:Location|URI): *(.*?) *\r\n!", $headers, $matches);
  $url = $matches[1];

  curl_close($ch);

  $url = $url . '?apikey=' . $apikey_sky;
  while (true) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded;  charset=UTF-8','Accept: application/json'));
    // curl_setopt($ch, CURLOPT_HEADER, true);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $r = curl_exec($ch);
    if($errno = curl_errno($ch)) {
        $error_message = curl_strerror($errno);
        echo "cURL error ({$errno}):\n {$error_message}";
    }

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpcode == 304) {
      continue;
    } else {
      break;
    }
  }

  $counter = 1;
  // print_r($r);
  $list_sky = json_decode($r);
  // echo json_encode($list_sky);
  $agents_sky = $list_sky->Agents;
  $segments_sky = $list_sky->Segments;
  $carriers_sky = $list_sky->Carriers;
  $places_sky = $list_sky->Places;
  $legs_sky = $list_sky->Legs;

  $agents = array();
  $legs = array();
  $leg = array();

  foreach ($list_sky->Itineraries as $itenary) {
    if ($counter > 20) break;
    $agent = array();
    foreach ($agents_sky as $agent_sky) {
      if ($agent_sky->Id == $itenary->PricingOptions[0]->Agents[0]) {
        $agent['name'] = $agent_sky->Name;
        $agent['img'] = $agent_sky->ImageUrl;

        array_push($agents, $agent);
      }
    }
    foreach ($legs_sky as $leg_sky) {
      if ($leg_sky->Id == $itenary->OutboundLegId) {
        $leg['arrivalTime'] = $leg_sky->Arrival;
        $leg['departureTime'] = $leg_sky->Departure;
        $leg['stops'] = $leg_sky->Stops;
        $leg['duration'] = $leg_sky->Duration;
        $leg['flights'] = array();
        foreach ($leg_sky->FlightNumbers as $flightNum) {
          foreach ($carriers_sky as $carrier_sky) {
            if ($carrier_sky->Id == $flightNum->CarrierId) {
              $flight = array(
                'imageUrl' => $carrier_sky->ImageUrl,
                'code' => $carrier_sky->Code . '-' . $flightNum->FlightNumber,
                'name' => $carrier_sky->Name
              );
              array_push($leg['flights'], $flight);
            }
          }
        }
        array_push($legs, $leg);
      }
    }

     if (in_array($leg['flights'][0]['name'], $maskapai_filter) && ((int)str_replace(':','',substr($leg['departureTime'], 11, 5)) >= (int)str_replace(':','',$outbond_time_one) &&  (int)str_replace(':','',substr($leg['departureTime'], 11, 5)) <= (int)str_replace(':','', $outbond_time_two))){
        $result = array(
        'departure' => array(
          'id' => $itenary->OutboundLegId,
          'flight_number' => $leg['flights'][0]['code'],
          'full_via'=> $origin . " - " . $destination . ' (' . substr($leg['departureTime'], 11, 5) . ' - ' . substr($leg['arrivalTime'], 11, 5) . ')',
          'image' => $leg['flights'][0]['imageUrl'],
          'simple_departure_time' => $leg['departureTime'],
          'simple_arrival_time' => $leg['arrivalTime'],
          'transit' => $leg['stops'],
          'duration' => $leg['duration'],
          'origin' => $origin,
          'destination' => $destination,
          'price' => $itenary->PricingOptions[0]->Price,
          'deepLink' => $itenary->PricingOptions[0]->DeeplinkUrl
        ),
        'total_price' => intval($itenary->PricingOptions[0]->Price),
        'type' => 'sky'
      );
      array_push($unsorted_result, $result);
     };

    $counter++;
  }

  $sorted_result = array();
  foreach ($unsorted_result as $key => $row) {
    $sorted_result[$key] = $row['total_price'];
  }
  array_multisort($sorted_result, SORT_ASC, $unsorted_result);

  $final_result = array(
    'results' => $unsorted_result,
    'origin_name' => $origin_name,
    'destination_name' => $destination_name,
    'departure_date_formatted' => $departure_date_formatted,
    'json_input' => $undecode_json
  );

  print json_encode($final_result);
  // print_r($list_tikets);
  // echo "OK"
?>

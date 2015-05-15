
<?php

$consumer_key = 'BYWbpuAelicAQqV6E4eucQ';
$consumer_secret = 'gkbVDyNIY7rjMPYZEeBttg';
$search_for = urlencode('Proc. ISSST');
$url = 'http://api.figshare.com/v1/my_data/authors?search_for='.$search_for;
$method = 'GET';

$oauth = new OAuth($consumer_key,$consumer_secret);
$oauth->setToken('HSq19f137oUg2aLDNumRCAbIKYVgWbvEcqRwjRRlHf3gHSq19f137oUg2aLDNumRCA','v60f4HIVXCBOCRh9hFXamQ');

$OA_header = $oauth->getRequestHeader($method, $url);

$headers = array("Authorization: $OA_header");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
$response = json_decode($response);
?>

<pre><?php print_r($response);?></pre>
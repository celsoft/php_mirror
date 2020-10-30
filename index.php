<?php

$mirror = "apparatov.net";		// Change this value to the site you want to mirror.

$url = "https://{$mirror}{$_SERVER['REQUEST_URI']}";

// get header
$header = get_headers($url, 1);

if ( 200 == intval(substr($header[0], 9, 3)) ) {

	// create a new cURL resource
	$ch = curl_init();

    // set URL and other appropriate options
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	$result = curl_exec($ch);

	$info = curl_getinfo($ch);
	$contentType = $info['content_type'];

	@header("Content-Type: $contentType");

	echo $result;

    // close cURL resource, and free up system resources
	curl_close($ch);

}
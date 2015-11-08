<?php

// All configuration settings are in config.php
require_once 'config.php';

if( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
	header($_SERVER['SERVER_PROTOCOL'].' 405 Method Not Allowed', 405, true); 
	http_response_code(405);
	exit('This script accepts only POST requests');
}

/**
 * Shorthand function for accessing $_POST variables
 */
function postvar( $var, $default = null ) {
	return isset($_POST[$var]) ? $_POST[$var] : $default;
}

if( postvar('xpwd') == $XPWD ) {
	
	if ( !empty($allowed_track_types) && !in_array(postvar('songtype', -1), $allowed_track_types) ) {
		exit('Track type '.postvar('songtype').' not allowed');
	}
	
	$album_art = postvar('cover');
	
	// Check if album art exists on update and generate full URL, so we don't have to check it every time the display.php is requested by visitor
	if( !empty($album_art) && file_exists($album_art_PATH . $album_art) ) {
		$album_art = $album_art_URL . $album_art;
	} else {
		$album_art = file_exists($album_art_PATH.$album_art_fallback_image)? $album_art_URL.$album_art_fallback_image : false;
		if( DEBUG ) {
			file_put_contents( 'debug.log', date('Y-m-d H:i:s')." album art file '{$album_art_PATH}{$album_art}' does not exist. Using fallback image.\n", FILE_APPEND );
		}
	}

	$data_to_save = array(
		'artist' => postvar('artist'),
		'title' => postvar('title'),
		'album' => postvar('album'),
		'songid' => postvar('songid'),
		'cover' => $album_art,
		'year' => postvar('year'),
		'listeners' => postvar('listeners'),
		'duration' => postvar('duration'),
		'songtype' => postvar('songtype'),
		'categoryid' => postvar('catid'),
		'station' => postvar('station'),
		'slogan' => postvar('slogan'),
		'requester' => postvar('requester'),
		'reqmessage' => postvar('reqmessage')
	);

	if( DEBUG ) {
		file_put_contents( 'debug.log', date('Y-m-d H:i:s').' data received: '.print_r($data_to_save, true)."\n", FILE_APPEND );
	}
	
	$datatest = serialize($data_to_save);
	file_put_contents($data_file, $datatest);
	echo 'Data successfully saved';
}
?>
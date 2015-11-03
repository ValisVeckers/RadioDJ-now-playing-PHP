<?php

$XPWD = 'RADIODJ_NOW_PLAYING_INFO_PASSWORD';	// The password set in RadioDJ Now Playing Info plugin Web Export options

$album_art_PATH = 'album_art/';					// Change this to the PATH of album art

$album_art_URL = 'http://www.YOURRADIOSITE.com/album_art/';					// Change this to the URL or location of album art

$album_art_fallback_image = 'no-album-art.jpg';	// Change this to image file name you want to show if there is no album art image for track and place that image in album_art folder. The file MUST EXIST or else no image will be displayed!

$data_file = 'radiodj.txt';						// File name for writing data

// **************** DO NOT EDIT BELOW THIS LINE ************************************//
// ******************** THERE BE DRAGONS!!! ****************************************//

//date_default_timezone_set('America/New_York');
// This should suffice
date_default_timezone_set(date_default_timezone_get());

define('DEBUG', true); // Simple switch for debugging. Will output all errors to browser when turned on and log some debugging info to debug.log.

/**
 *	Track types for which radiodj.php is allowed to save updated info sent by RadioDJ
 *	Uncomment as required by removing first two slashes "//" at the begging of line
 */
$allowed_track_types = array(
	0, // Music
//	1, // Jingle
//	2, // Sweeper
//	3, // Voiceover
//	4, // Commercial
	5, // Internet Stream
//	6, // Other
	7, // VDF (Variable Duration File)
	8, // Podcast
//	9, // Request ???
	10, // News
//	11, // Playlist Event
	12, // FileByDate
	13, // NewestFromFolder
//	14, // Teaser
);

!defined('DEBUG') && define('DEBUG', false);

if( defined('DEBUG') && DEBUG == true ) {
	error_reporting( E_ALL );
	ini_set( 'display_errors', 1 );
} else {
	error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );
	ini_set( 'display_errors', 0 );
}
ini_set('log_errors', 1);
ini_set('error_log', 'radiodj_php_errors.log');

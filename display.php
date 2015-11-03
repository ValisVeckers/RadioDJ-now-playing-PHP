<?php
require_once 'config.php';
$toBeRestored = file_get_contents($data_file);
$data = unserialize($toBeRestored);

$nowPlayingTitle = '';

if(isset($data['title']) && isset($data['artist'])) {
	$nowPlayingTitle = $data['title'] . ' - ' . $data['artist'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Now Playing: <?php echo $nowPlayingTitle; ?></title>
	<style media="screen">@import "display.css";</style>
</head>
<body>
<?php
if( defined('DEBUG') && DEBUG == true && isset($_GET['bebug']) ) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}
?>
	<div class="now-playing clearfix">

		<figure class="album-art">
		<?php if( !empty($data['cover']) ) : ?>
			<img src="<?php echo $data['cover']; ?>" width="200" />
			<figcaption><?php echo $data['album']; ?></figcaption>
		<?php endif; ?>
		</figure>

		<div class="artist"><small>Artist:</small><?php echo $data['artist']; ?></div>

		<div class="title"><small>Title:</small><?php echo $data['title']; ?></div>

		<?php if( !empty($data['album']) ): ?>
		<div class="album"><small>Album:</small><?php echo $data['album']; ?></div>
		<?php endif; ?>

		<?php if( !empty($data['year']) ): ?>
		<div class="year"><small>Year:</small><?php echo $data['year']; ?></div>
		<?php endif; ?>

	</div>
</body>
</html>
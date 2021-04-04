<?php

const PREVIEW_WIDTH  = 200;
const PREVIEW_HEIGHT = 100;

if (!file_exists('image_preview.png')) {
	$image   = imagecreatefrompng('image.png');
	$preview = imagecreatetruecolor(PREVIEW_WIDTH, PREVIEW_HEIGHT);
	
	$pw = PREVIEW_WIDTH;
	$ph = PREVIEW_HEIGHT;
	$pmax = max($pw, $ph);
	
	$iw = imagesx($image);
	$ih = imagesy($image);
	$imin = min($iw, $ih);
	
	$k = $imin / $pmax;
	
	$w = $k * $pw;
	$h = $k * $ph;
	$x = ($iw - $w) / 2;
	$y = ($ih - $h) / 2;
	
	imagecopyresampled(
		$preview,  $image,
		0,   0,    $x, $y,
		$pw, $ph,  $w, $h
	);
	
	imagepng($preview, 'image_preview.png');
}

?>
<img src="image_preview.png" />

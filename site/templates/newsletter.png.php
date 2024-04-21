<?php

/** @var Kirby\Cms\Page $page */

// Define canvas size
$canvas = imagecreatetruecolor(1200, 628);

// Define colors
$brandColor = imagecolorallocate($canvas, 167, 49, 209);
$backgroundColor = imagecolorallocate($canvas, 255, 255, 255);
$textColor = imagecolorallocate($canvas, 0, 0, 0);

// Set background
imagefill($canvas, 0, 0, $backgroundColor);

// Draw rectangle
imagefilledrectangle($canvas, 100, 100, 115, 525, $brandColor);

// Path to .ttf font file
$fontFile = './assets/opengraph/Inter-SemiBold.ttf';

// Write page title to canvas
//$title = $page->title()->toString();
//$title = wordwrap($title, 30);
$text = 'Le storie della settimana';
imagefttext($canvas, 50, 0, 150, 185, $textColor, $fontFile, $text);

$text = $page->title()->toDate('d MMMM y');
imagefttext($canvas, 22, 0, 150, 235, $textColor, $fontFile, $text);

// Place logo in the corner
$logoFile = './assets/logo.png';
$logo = imagecreatefrompng($logoFile);
$original_width = imagesx($logo);
$original_height = imagesy($logo);
$width = 400;
$height = (int)($original_height / $original_width * $width);
imagecopyresampled($canvas, $logo, 150, 455, 0, 0, $width, $height, $original_width, $original_height);

// Output image to the browser
imagepng($canvas);
imagedestroy($canvas);

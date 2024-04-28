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

// Write section header
$blocks = $page->blocks()->toBlocks();
$text = $page->date()->toDate('d MMMM y') . '  •  ' . strtoupper($blocks->first()->text());
imagefttext($canvas, 17, 0, 150, 150, $textColor, $fontFile, $text);

// Write page title to canvas
$text = wordwrap($page->title(), 35);
$coords = imagefttext($canvas, 40, 0, 150, 215, $textColor, $fontFile, $text, ['linespacing' => 0.9]);

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

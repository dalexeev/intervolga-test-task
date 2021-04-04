<?php

$img = imagecreate(20000, 20000);

$bgc = imagecolorallocate($img, 0, 0, 0);
imagefill($img, 0, 0, $bgc);

$fgc = imagecolorallocate($img, 255, 0, 0);
imagefilledellipse($img, 10000, 10000, 20000, 20000, $fgc);

imagepng($img, 'image.png');
echo 'Готово.';

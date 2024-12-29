<?php

session_start();
$random_alpha = md5(rand());
$captcha_code = substr($random_alpha, 0, 6);
$_SESSION["captcha_code"] = $captcha_code;
$target_layer = imagecreatetruecolor(70,30);

$captcha_background = imagecolorallocate($target_layer, 67, 67, 67);

$captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
$noise_color = imagecolorallocate($target_layer, 100, 120, 180);

imagefill($target_layer,0,0,$captcha_background);

for ($i = 0; $i < 100; $i++) {
    imagesetpixel($target_layer, rand(0, 70), rand(0, 30), $noise_color);
}

for ($i = 0; $i < 10; $i++) {
    imageline($target_layer, rand(0, 70), rand(0, 30), rand(0, 70), rand(0, 30), $noise_color);
}

imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color);

header("Content-type: image/jpeg");
imagejpeg($target_layer);

?>
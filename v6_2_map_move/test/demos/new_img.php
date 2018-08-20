<?php


/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    $targ_w = $targ_h = 150;
    $targ_w = $_POST["w"];
    $targ_h = $_POST["h"];
    $jpeg_quality = 100;

    $src = 'demo_files/pool.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'],
        $targ_w, $targ_h, $_POST['w'], $_POST['h']);

    header('Content-type: image/jpeg');
//    imagejpeg($dst_r, null, $jpeg_quality);
    imagejpeg($dst_r);


}

// If not a POST request, display page below:

?>
<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targ_w = $targ_h = 150;
    $jpeg_quality = 90;

    $src = 'demo_files/pool.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

    imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'],
        $targ_w, $targ_h, $_POST['w'], $_POST['h']);

    header('Content-type: image/jpeg');
    imagejpeg($dst_r, null, $jpeg_quality);

    exit;
}

// If not a POST request, display page below:

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Live Cropping Demo</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.Jcrop.js"></script>
    <!--    <link rel="stylesheet" href="demo_files/main.css" type="text/css"/>-->
    <!--    <link rel="stylesheet" href="demo_files/demos.css" type="text/css"/>-->
    <!--    <link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css"/>-->

    <script type="text/javascript">

        $(function () {

            $('#cropbox').Jcrop({
                aspectRatio: 1,
                onSelect: updateCoords
            });

        });

        function updateCoords(c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };

        function checkCoords() {
            if (parseInt($('#w').val())) {
                return true;
            } else {
                alert('error');
                return false;
            }


        };

    </script>

</head>
<body>


<div>
    <!-- This is the image we're attaching Jcrop to -->
    <img src="demo_files/pool.jpg" id="cropbox"/>

    <!-- This is the form that our event handler fills -->
    <form action="crop.php" method="post" onsubmit="return checkCoords();">
        <input type="hidden" id="x" name="x"/>
        <input type="hidden" id="y" name="y"/>
        <input type="hidden" id="w" name="w"/>
        <input type="hidden" id="h" name="h"/>
        <input type="submit" value="Crop Image"/>
    </form>


</div>
</body>

</html>

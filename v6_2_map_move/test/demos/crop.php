
<!DOCTYPE html>
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
            if (parseInt($('#x').val())) {
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
    <form action="new_img.php" method="post" onsubmit="return checkCoords();">
        X: <input type="number" id="x" name="x"/><br>
        Y: <input type="number" id="y" name="y"/><br>
        W: <input type="number" id="w" name="w"/><br>
        H: <input type="number" id="h" name="h"/><br>
        <input type="submit" value="Crop Image"/>
    </form>


</div>
</body>

</html>

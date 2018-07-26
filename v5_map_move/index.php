<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>demo</title>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <style type="text/css">

        /*圖片*/
        .photo {
            position: absolute;
            z-index: 10;
            display: inline;
            width: 100px;
            height: 100px;
        }

        /*地圖範圍*/
        .map {
            position: absolute;
            z-index: 0;
            left: 0px; /*去除邊框*/
            top: 0px; /*去除邊框*/
        }

        /*通行*/
        .pass {
            height: 100px;
            width: 100px;
            display: inline;
            background: yellow;
            float: left;
        }

        /*障礙*/
        .obstacle {
            height: 100px;
            width: 100px;
            display: inline;
            background: blueviolet;
            float: left;
        }

    </style>
    <script type="text/javascript">
        // var map = [
        //     [0, 0, 0, 0],
        //     [0, 0, 1, 0]];
        var map = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 1, 0, 0, 1, 0, 0, 0, 0, 0]];
        // var map = [
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]];
        // var map = [
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0],
        //     [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0]];
        // map陣列值為 0 可以圖片通行
        // map陣列值為 1 可以圖片通行
        var map_vertical = map.length;// 欄
        var map_horizontal = map[map.length - 1].length;// 列
        var show_map_vertical_length = 2; // 顯示垂直長度
        var show_map_horizontal_length = 7; // 顯示水平長度
        var photo_vertical = 0;//3 圖片初始位置 陣列 欄
        var photo_horizontal = 2;//6 圖片初始位置 陣列 列
        var map_vertical_move = 0;
        var map_horizontal_move = 0;

        $(function () {

            // $("#start").css("top", photo_vertical * 100 + "px");// 圖片初始位置 陣列 欄
            // $("#start").css("left", photo_horizontal * 100 + "px");// 圖片初始位置 陣列 列
            // $("#top").css("top", photo_vertical * 100 + "px");// 圖片初始位置 陣列 欄
            // $("#top").css("left", photo_horizontal * 100 + "px");// 圖片初始位置 陣列 列
            // $("#down").css("top", photo_vertical * 100 + "px");// 圖片初始位置 陣列 欄
            // $("#down").css("left", photo_horizontal * 100 + "px");// 圖片初始位置 陣列 列
            // $("#left").css("top", photo_vertical * 100 + "px");// 圖片初始位置 陣列 欄
            // $("#left").css("left", photo_horizontal * 100 + "px");// 圖片初始位置 陣列 列
            // $("#right").css("top", photo_vertical * 100 + "px");// 圖片初始位置 陣列 欄
            // $("#right").css("left", photo_horizontal * 100 + "px");// 圖片初始位置 陣列 列
            // $("#map").css("height", map_vertical * 100 + "px");// 透過陣列 橫 得知地圖最大高度範圍
            // $("#map").css("width", map_horizontal * 100 + "px");//透過陣列 列 得知地圖最大長度範圍
            var left = photo_horizontal - 1;
            $("#start").css("left", left * 100);
            $("#map").css("height", show_map_vertical_length * 100 + "px");// 透過陣列 橫 得知地圖最大高度範圍
            $("#map").css("width", show_map_horizontal_length * 100 + "px");//透過陣列 列 得知地圖最大長度範圍
            console.log(photo_vertical + "," + photo_horizontal);
            console.log(" ")
            draw_print(photo_vertical, photo_horizontal);
            //
            //
            // for (var i = 0; i < map_vertical; i++) {
            //     for (var j = 0; j < map_horizontal; j++) {
            //         if (map[i][j] == 1) {
            //             $("#map").append("<div class='obstacle'>" + i + "," + j + "</div>");
            //             // 障礙物
            //         } else {
            //             $("#map").append("<div class='pass'>" + i + "," + j + "</div>");
            //             // 可通行
            //         }
            //     }
            // }

        });

        //
        function test(s, e, r, map_horizontal) {

            console.log("in " + s + "," + e + "_" + r);
            if (s < 0) {
                r = s + r;
                console.log("小 " + s + "," + e + "_" + r);
            }
            if (s > map_horizontal - (e - s + 1)) {
                r = s + (e - s + 1) - map_horizontal + r;
                // console.log(s);
                // console.log(map_horizontal);
                // console.log(e - s + 1);
                console.log(r)
                console.log("大 " + s + "," + e + "_" + r);
            }
            $("#start").css("left", r * 100);
            console.log(" ");
        }

        function draw_print(vertical, horizontal) {
            $("#map").empty();
            // 計算顯示地圖起始坐標和結束座標
            var vertical_range = Math.floor(show_map_vertical_length / 2);
            var horizontal_range = Math.floor(show_map_horizontal_length / 2);
            var map_vertical_start = vertical - vertical_range;
            var map_horizontal_start = horizontal - horizontal_range;
            var photo_horizontal_start = map_horizontal_start;
            var photo_horizontal_end = photo_horizontal_start + show_map_horizontal_length - 1;
            //
            // console.log("00_photo_left-> " + photo_left);
            // 修正邊界座標
            // 上面
            if (map_vertical_start < 0) {
                map_vertical_start = 0;
            }
            // 下面
            if (map_vertical_start > map_vertical - show_map_vertical_length) {
                map_vertical_start = map_vertical - show_map_vertical_length;
            }
            // // 左面
            if (map_horizontal_start < 0) {
                map_horizontal_start = 0;
            }

            if (map_horizontal_start > map_horizontal - show_map_horizontal_length) {// 右面
                map_horizontal_start = map_horizontal - show_map_horizontal_length;
            }


            //
            var map_vertical_end = map_vertical_start + show_map_vertical_length - 1;
            var map_horizontal_end = map_horizontal_start + show_map_horizontal_length - 1;


            for (var i = map_vertical_start; i <= map_vertical_end; i++) {
                for (var j = map_horizontal_start; j <= map_horizontal_end; j++) {
                    if (map[i][j] == 1) {
                        $("#map").append("<div class='obstacle'>" + i + "," + j + "</div>");
                        // 障礙物
                    } else {
                        $("#map").append("<div class='pass'>" + i + "," + j + "</div>");
                        // 可通行
                    }
                }
            }

            test(photo_horizontal_start, photo_horizontal_end, horizontal_range, map_horizontal);

            //
            // $("#start").css("top", 100 * vertical);
            // $("#start").css("left", 100 * photo_left);
            // console.log(100 * horizontal-1);
            $("#start").css("display", "inline");
        }

        $(document).keydown(function (event) {
            // $("#start").css("display", "none");
            // $("#top").css("display", "none");
            // $("#down").css("display", "none");
            // $("#left").css("display", "none");
            // $("#right").css("display", "none");
            //
            switch (event.which) {
                case 37:// 鍵盤 左按鍵
                    if (photo_horizontal > 0) {
                        //
                        photo_horizontal -= 1; // 陣列向左移動
                        if (map[photo_vertical][photo_horizontal] == 0) { // 可以通行
                            // 四個圖片同時移動
                            // $("#start").css("left", photo_horizontal * 100 + "px");
                            // $("#top").css("left", photo_horizontal * 100 + "px");
                            // $("#down").css("left", photo_horizontal * 100 + "px");
                            // $("#left").css("left", photo_horizontal * 100 + "px");
                            // $("#right").css("left", photo_horizontal * 100 + "px");
                            // 地圖移動
                            // map_horizontal_move += 1;
                            // var horizontal_range = map_horizontal - Math.abs(map_horizontal_move);
                            // if (map_horizontal_move <= 0 && horizontal_range >= show_map_horizontal_length) {
                            //     $("#map").css("margin-left", map_horizontal_move * 100);
                            // }
                        } else {
                            photo_horizontal += 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                    }
                    // 顯上左邊圖片
                    $("#left").css("display", "inline");
                    break;
                case 38:// 鍵盤 上按鍵
                    if (photo_vertical > 0) {
                        //
                        photo_vertical -= 1;// 陣列向上移動
                        if (map[photo_vertical][photo_horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            // $("#start").css("top", photo_vertical * 100 + "px");
                            // $("#top").css("top", photo_vertical * 100 + "px");
                            // $("#down").css("top", photo_vertical * 100 + "px");
                            // $("#left").css("top", photo_vertical * 100 + "px");
                            // $("#right").css("top", photo_vertical * 100 + "px");
                            // 地圖移動
                            // map_vertical_move += 1;
                            // var vertical_range = map_vertical - Math.abs(map_vertical_move);
                            //
                            // if (map_vertical_move <= 0 && vertical_range >= show_map_vertical_length) {
                            //     $("#map").css("margin-top", map_vertical_move * 100);
                            // }

                        } else {
                            photo_vertical += 1;// 不能通行，將陣列向上移動。設為原來位置
                        }
                    }
                    // 顯上上面圖片
                    $("#top").css("display", "inline");
                    break;
                case 39:// 鍵盤 右按鍵
                    if (photo_horizontal < map_horizontal - 1) {
                        //
                        photo_horizontal += 1;// 陣列向右移動
                        if (map[photo_vertical][photo_horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            // $("#start").css("left", photo_horizontal * 100 + "px");
                            // $("#top").css("left", photo_horizontal * 100 + "px");
                            // $("#down").css("left", photo_horizontal * 100 + "px");
                            // $("#left").css("left", photo_horizontal * 100 + "px");
                            // $("#right").css("left", photo_horizontal * 100 + "px");
                            // 地圖移動
                            // map_horizontal_move -= 1;
                            // var horizontal_range = map_horizontal - Math.abs(map_horizontal_move);
                            //
                            // if (map_horizontal_move <= 0 && horizontal_range >= show_map_horizontal_length) {
                            //     $("#map").css("margin-left", map_horizontal_move * 100);
                            // }

                        } else {
                            photo_horizontal -= 1;// 不能通行，將陣列向右移動。設為原來位置
                        }
                    }
                    // 顯上右邊圖片
                    $("#right").css("display", "inline");
                    break;
                case 40:// 鍵盤 下按鍵
                    if (photo_vertical < map_vertical - 1) {
                        photo_vertical += 1;// 陣列向下移動
                        if (map[photo_vertical][photo_horizontal] == 0) {// 可以通行
                            // 四個圖片同時移動
                            // $("#start").css("top", photo_vertical * 100 + "px");
                            // $("#top").css("top", photo_vertical * 100 + "px");
                            // $("#down").css("top", photo_vertical * 100 + "px");
                            // $("#left").css("top", photo_vertical * 100 + "px");
                            // $("#right").css("top", photo_vertical * 100 + "px");
                            // 地圖移動
                            // map_vertical_move -= 1;
                            // var vertical_range = map_vertical - Math.abs(map_vertical_move);
                            //
                            // if (map_vertical_move <= 0 && vertical_range >= show_map_vertical_length) {
                            //     $("#map").css("margin-top", map_vertical_move * 100);
                            // }

                        } else {
                            photo_vertical -= 1;// 不能通行，將陣列向下移動。設為原來位置
                        }
                        //
                    }
                    // 顯上下面圖片
                    $("#down").css("display", "inline");
                    break;
                default:
                    $("#start").css("display", "inline");
                    break;
            }
            console.log(photo_vertical + "," + photo_horizontal);
            draw_print(photo_vertical, photo_horizontal);
            console.log(" ");
        });
    </script>

</head>
<!--<div class="top"></div>-->
<!--<div class="left"></div>-->
<!--地圖-->
<div id="game" class="fixed-top">
    <div id="map" class="map"></div>
    <!--圖片-->
    <img id="start" class="photo" src="photo/start.jpg">
    <!--    <img id="top" class="photo" src="photo/top.png" style="display: none">-->
    <!--    <img id="down" class="photo" src="photo/down.png" style="display: none">-->
    <!--    <img id="left" class="photo" src="photo/left.png" style="display: none">-->
    <!--    <img id="right" class="photo" src="photo/right.png" style="display: none">-->
</div>
<!--<div id="map_right" class="right"></div>-->
<!--<div id="map_bottom" class="bottom"></div>-->


</body>
</html>
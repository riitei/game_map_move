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

</head>

<!--地圖-->
<div id="game" class="fixed-top">
    <div id="map" class="map"></div>
    <!--圖片-->
    <img id="start" class="photo" src="photo/start.jpg">
    <img id="top" class="photo" src="photo/top.png" style="display: none">
    <img id="down" class="photo" src="photo/down.png" style="display: none">
    <img id="left" class="photo" src="photo/left.png" style="display: none">
    <img id="right" class="photo" src="photo/right.png" style="display: none">
</div>

<script type="text/javascript">
    // var map = [
    //     [0, 0, 0, 0],
    //     [0, 0, 1, 0]];
    var map = [
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 1, 0, 0, 1, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    ];
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
    var show_map_horizontal_length = 9; // 顯示水平長度
    var photo_vertical = 0;//3 圖片初始位置 陣列 欄
    var photo_horizontal = 8;//6 圖片初始位置 陣列 列
    // 初始地圖
    $("#map").css("height", show_map_vertical_length * 100 + "px");// 透過陣列 橫 得知地圖最大高度範圍
    $("#map").css("width", show_map_horizontal_length * 100 + "px");//透過陣列 列 得知地圖最大長度範圍
    //
    var draw_photo =
        draw_print(map, photo_vertical, photo_horizontal, map_vertical, map_horizontal, show_map_vertical_length, show_map_horizontal_length);
    //
    var top = photo_move_range(
        draw_photo["photo_vertical_start"],
        draw_photo["photo_vertical_end"],
        draw_photo["vertical_range"],
        draw_photo["map_vertical"]);
    var left = photo_move_range(
        draw_photo["photo_horizontal_start"],
        draw_photo["photo_horizontal_end"],
        draw_photo["horizontal_range"],
        draw_photo["map_horizontal"]);
    show_photo_move(top, left, "start");
    // 鍵盤出發圖片在地圖移動方向
    $(document).keydown(function (event) {
        //
        // var direction = "";
        var move_place;
        //
        switch (event.which) {
            case 37:// 鍵盤 左按鍵
                move_place = move("left", photo_vertical, photo_horizontal, map_vertical, map_horizontal);
                break;
            case 38:// 鍵盤 上按鍵
                move_place = move("top", photo_vertical, photo_horizontal, map_vertical, map_horizontal);
                break;
            case 39:// 鍵盤 右按鍵
                move_place = move("right", photo_vertical, photo_horizontal, map_vertical, map_horizontal);
                break;
            case 40:// 鍵盤 下按鍵
                move_place = move("down", photo_vertical, photo_horizontal, map_vertical, map_horizontal);
                break;
            default:
                $("#start").css("display", "inline");
                break;
        }
        // 算出移動需要座標位置後判斷是否通行
        if (move_place) {
            var direction = pass(
                map[move_place["new_vertical"]][move_place["new_horizontal"]],
                move_place["new_vertical"],
                move_place["new_horizontal"],
                move_place["place_direction"],
                move_place["old_vertical"],
                move_place["old_horizontal"]);
            photo_vertical = direction.now_vertical;
            photo_horizontal = direction.now_horizontal;
            //
            console.log(photo_vertical + "," + photo_horizontal);
            var draw_photo =
                draw_print(
                    map,
                    photo_vertical,
                    photo_horizontal,
                    map_vertical,
                    map_horizontal,
                    show_map_vertical_length,
                    show_map_horizontal_length);
            var top = photo_move_range(
                draw_photo["photo_vertical_start"],
                draw_photo["photo_vertical_end"],
                draw_photo["vertical_range"],
                draw_photo["map_vertical"]);
            var left = photo_move_range(
                draw_photo["photo_horizontal_start"],
                draw_photo["photo_horizontal_end"],
                draw_photo["horizontal_range"],
                draw_photo["map_horizontal"]);
            show_photo_move(top, left, move_place["place_direction"]);
        }

    });// key

    // 圖片移動是否超出界線
    function move(direction, photo_vertical, photo_horizontal, map_vertical, map_horizontal) {
        var coordinate = new Array();
        // 紀錄原座標
        coordinate["old_vertical"] = photo_vertical;
        coordinate["old_horizontal"] = photo_horizontal;
        // 初始新座標
        coordinate["new_vertical"] = photo_vertical;
        coordinate["new_horizontal"] = photo_horizontal;

        switch (direction) {
            case "left":
                if (photo_horizontal > 0) { // 防止超過界線
                    coordinate["new_horizontal"] = photo_horizontal - 1; // 陣列向左移動
                    coordinate["place_direction"] = "left"
                } else {
                    coordinate = null;
                }
                break;
            case "top":
                if (photo_vertical > 0) { // 防止超過界線
                    coordinate["new_vertical"] = photo_vertical - 1;// 陣列向上移動
                    coordinate["place_direction"] = "top";
                } else {
                    coordinate = null;
                }
                break;
            case"right":

                if (photo_horizontal < map_horizontal - 1) { // 防止超過界線
                    coordinate["new_horizontal"] = photo_horizontal + 1;// 陣列向右移動
                    coordinate["place_direction"] = "right";
                } else {
                    coordinate = null;
                }
                break;
            case"down":
                if (photo_vertical < map_vertical - 1) { // 防止超過界線
                    coordinate ["new_vertical"] = photo_vertical + 1;// 陣列向下移動
                    coordinate ["place_direction"] = "down";
                } else {
                    coordinate = null;
                }
                break;
        }//switch
        return coordinate;

    } // move

    // 判斷是否通行
    function pass(map, new_vertical, new_horizontal, place_direction, old_vertical, old_horizontal) {
        var now_vertical;
        var now_horizontal;
        if (map == 0) {// 可以通行

            // 更新目前座標
            now_vertical = new_vertical;
            now_horizontal = new_horizontal;

        } else { // 不可通行
            // 存放未移動座標位置
            now_vertical = old_vertical;
            now_horizontal = old_horizontal;
        }

        return {"now_vertical": now_vertical, "now_horizontal": now_horizontal};

    }


    function photo_move_range(photo_start, photo_end, range, map_horizontal) {

        if (photo_start < 0) {
            range = photo_start + range;
        }
        if (photo_start > map_horizontal - (photo_end - photo_start + 1)) {
            range = photo_start + (photo_end - photo_start + 1) - map_horizontal + range;
        }
        return range;
    }

    function draw_print(map, photo_vertical, photo_horizontal, map_vertical, map_horizontal, show_map_vertical_length, show_map_horizontal_length) {
        $("#map").empty();
        // 計算顯示地圖起始坐標和結束座標
        var vertical_range = Math.floor(show_map_vertical_length / 2);
        var horizontal_range = Math.floor(show_map_horizontal_length / 2);
        //
        var map_vertical_start = photo_vertical - vertical_range;
        var map_horizontal_start = photo_horizontal - horizontal_range;
        //
        var photo_vertical_start = map_vertical_start;
        var photo_vertical_end = photo_vertical_start + show_map_vertical_length - 1;
        //
        var photo_horizontal_start = map_horizontal_start;
        var photo_horizontal_end = photo_horizontal_start + show_map_horizontal_length - 1;
        //
        // 上面
        if (map_vertical_start < 0) {
            map_vertical_start = 0;
        }
        // 下面
        if (map_vertical_start > map_vertical - show_map_vertical_length) {
            map_vertical_start = map_vertical - show_map_vertical_length;
        }
        // 左面
        if (map_horizontal_start < 0) {
            map_horizontal_start = 0;
        }
        // 右面
        if (map_horizontal_start > map_horizontal - show_map_horizontal_length) {// 右面
            map_horizontal_start = map_horizontal - show_map_horizontal_length;
        }
        //
        var map_vertical_end = map_vertical_start + show_map_vertical_length - 1;
        var map_horizontal_end = map_horizontal_start + show_map_horizontal_length - 1;
        //
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
        return {
            "photo_vertical_start": photo_vertical_start,
            "photo_vertical_end": photo_vertical_end,
            "photo_horizontal_start": photo_horizontal_start,
            "photo_horizontal_end": photo_horizontal_end,
            "vertical_range": vertical_range,
            "horizontal_range": horizontal_range,
            "map_vertical": map_vertical,
            "map_horizontal": map_horizontal
        };
    }

    function show_photo_move(top, left, direction) {

        $("#start,#top,#down,#left,#right").css("top", top * 100);
        $("#start,#top,#down,#left,#right").css("left", left * 100);
        $("#start,#top,#down,#left,#right").css("display", "none");

        switch (direction) {
            case "top":
                $("#top").css("display", "inline");
                break;
            case "down":
                $("#down").css("display", "inline");
                break;
            case "left":
                $("#left").css("display", "inline");
                break;
            case "right":
                $("#right").css("display", "inline");
                break;
            default:
                $("#start").css("display", "inline");
                break;
        }
    }
</script>


</body>
</html>
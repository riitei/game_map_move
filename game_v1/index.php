<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>game</title>
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
    <script src="character.js"></script>
    <style type="text/css">

        /*圖片*/
        .photo {
            position: absolute;
            z-index: 5;
            display: inline;
            height: 40px;
            width: 20px;
        }

        /*以達成視窗左右平分*/
        .center {
            /*margin: auto;*/
            float: left;
        }

        .example {
            top: 50px;
            left: 100px;

            position: absolute;
            z-index: 100;

            background: white;
            width: 500px;
            height: 200px;
            overflow: hidden;
            border: red 5px solid;
            display: none;

        }




    </style>

    <?php
    include "map_move_json/test.php";

    ?>


</head>

<body>

<div id="game" class="fixed-top">
    <div id="menu" style="background: #0e90d2; width: 150px;float: left">
        <div id="control">
            <p>　</p>
            <div>
                <button id="StopGame" class="btn btn-primary">Pause</button>
            </div>
            <div>
                <button id="Restart" onclick="startNewGame()" class="btn btn-info">Restart</button>
            </div>
            <div><h5 style="color:red">Volume</h5></div>
            <input type="range" min="0" max="100" value="100" onchange="SetValume(this.value)">
            <div><h5 style="color:red">Text speed</h5></div>
            <input type="range" min="0" max="100" value="0" onchange="SetTextSpeed(this.value)">
            <form role="form" method="post" action="../levels.php">
                <div>
                    <button id="backtomenu" class="btn btn-lg btn-success btn-block" type="submit">Levels</button>
                </div>
            </form>
            <div id="test">

            </div>
        </div>
    </div>
    <div id="center" class="center">
        <canvas id="show" height="2400px" width="2400px"></canvas>

        <img id="start" class="photo" src="photo/start.jpg">
        <img id="top" class="photo" src="photo/top.png" style="display: none">
        <img id="down" class="photo" src="photo/down.png" style="display: none">
        <img id="left" class="photo" src="photo/left.png" style="display: none">
        <img id="right" class="photo" src="photo/right.png" style="display: none">

    </div>


    <div id="dialgo" class="example">
        <div id="mess">
        </div>
        <button id="btn_up" type="button" value="0">上一句</button>

        <button id="btn_down" type="button" value="0">下一句</button>

        <!--            aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa-->

    </div>
</div>

</body>

<script type="text/javascript">


    var map = <?=json_encode($map)?>;
    var all_map_vertical_length = JSON.parse(<?=$height?>);
    var all_map_horizontal_length = JSON.parse(<?=$width?>);
    var show_map_vertical_length = 50; // 顯示垂直長度
    var show_map_horizontal_length = 50; // 顯示水平長度

    // 圖片 中心點
    var photo_center_vertical = 60;//3 圖片初始位置 陣列 欄
    var photo_center_horizontal = 80;//6 圖片初始位置 陣列 列

    var block_vertical_height = JSON.parse(<?=$tileheight?>); // 初始每一個地圖的高度
    var block_horizontal_width = JSON.parse(<?=$tilewidth?>); // 初始每一個地圖的寬度
    //
    // 初始地圖
    document.getElementById("show")
        .setAttribute("height", all_map_vertical_length * block_vertical_height + "px");
    document.getElementById("show")
        .setAttribute("width", all_map_horizontal_length * block_horizontal_width + "px");


    var photo_vertical_length = Math.ceil($("#start").css("height").replace(/[^0-9]/ig, ""));
    var photo_horizontal_length = Math.ceil($("#start").css("width").replace(/[^0-9]/ig, ""));
    var meun_width = $("#menu").css("width").replace(/[^0-9]/ig, "");
    var map_width = $("#show").css("width").replace(/[^0-9]/ig, "");
    var trajectory_status = "pass"; // 紀錄軌跡狀態
    var trajectory = new Array();// 存放紀錄軌跡筆數
    var trajectory_count = 0;// 計算紀錄筆數
    var isChange = false;// 判斷是否重新整理


    $("#game").css("width", meun_width + map_width + "px");
    // 計算圖片暫用多少地圖block num
    var photo_block_vertical_height = Math.ceil(photo_vertical_length / block_vertical_height);
    var photo_block_horizontal_width = Math.ceil(photo_horizontal_length / block_horizontal_width);
    // 修正圖長寬片佔滿block
    var photo_height = photo_block_vertical_height * block_vertical_height;
    var photo_width = photo_block_horizontal_width * block_horizontal_width;
    $(".photo").css("height", photo_height + "px");
    $(".photo").css("width", photo_width + "px");
    var c = document.getElementById("show");
    var ctx = c.getContext("2d");
    var imageObj = new Image();
    imageObj.src = "map_move_json/map.png";

    var draw_photo =
        draw_print(
            map,
            photo_center_vertical,
            photo_center_horizontal,
            all_map_vertical_length,
            all_map_horizontal_length,
            show_map_vertical_length,
            show_map_horizontal_length,
            block_vertical_height,
            block_horizontal_width);

    show_photo_move(photo_center_vertical, photo_center_horizontal,
        photo_block_vertical_height, photo_block_horizontal_width,
        all_map_vertical_length, all_map_horizontal_length,
        draw_photo["map_vertical_start"], draw_photo["map_horizontal_start"],
        "start");


    // 鍵盤出發圖片在地圖移動方向
    $(document).keydown(function (event) {
        //
        var move_place;
        isChange = true;
        $(this).addClass("editing");
        //
        switch (event.which) {
            case 37:// 鍵盤 左按鍵
                move_place =
                    move("left",
                        photo_center_vertical, photo_center_horizontal,
                        all_map_vertical_length, all_map_horizontal_length,
                        photo_block_vertical_height, photo_block_horizontal_width);
                break;
            case 38:// 鍵盤 上按鍵
                move_place =
                    move("top",
                        photo_center_vertical, photo_center_horizontal,
                        all_map_vertical_length, all_map_horizontal_length,
                        photo_block_vertical_height, photo_block_horizontal_width);
                break;
            case 39:// 鍵盤 右按鍵
                move_place = move("right",
                    photo_center_vertical, photo_center_horizontal,
                    all_map_vertical_length, all_map_horizontal_length,
                    photo_block_vertical_height, photo_block_horizontal_width);
                break;
            case 40:// 鍵盤 下按鍵
                move_place = move("down",
                    photo_center_vertical, photo_center_horizontal,
                    all_map_vertical_length, all_map_horizontal_length,
                    photo_block_vertical_height, photo_block_horizontal_width);
                break;
            default:
                $("#start").css("display", "inline");
                break;
        }
        // 算出移動需要座標位置後判斷是否通行
        if (move_place) {
            var direction = pass(
                map,
                move_place["new_vertical"],
                move_place["new_horizontal"],
                move_place["old_vertical"],
                move_place["old_horizontal"],
                photo_block_vertical_height,
                photo_block_horizontal_width,
                all_map_vertical_length,
                all_map_horizontal_length
            );
            photo_center_vertical = direction.now_vertical;
            photo_center_horizontal = direction.now_horizontal;

            // 繪製地圖
            var draw_photo =
                draw_print(
                    map,
                    photo_center_vertical,
                    photo_center_horizontal,
                    all_map_vertical_length,
                    all_map_horizontal_length,
                    show_map_vertical_length,
                    show_map_horizontal_length,
                    block_vertical_height,
                    block_horizontal_width);
            // 算圖片座標
            show_photo_move(photo_center_vertical, photo_center_horizontal,
                photo_block_vertical_height, photo_block_horizontal_width,
                all_map_vertical_length, all_map_horizontal_length,
                draw_photo["map_vertical_start"], draw_photo["map_horizontal_start"],
                move_place["place_direction"]);


            var now = new Date();


            var trajectory_date =
                now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate() + " "
                + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
            var trajectory_coordinate = photo_center_vertical + "," + photo_center_horizontal;
            // 把log 存放 stack
            // if (trajectory.length < 3) {
            console.log("push");
            var t = {
                "trajectory_date": trajectory_date,
                "trajectory_coordinate": trajectory_coordinate,
                "trajectory_status": trajectory_status
            };
            trajectory.push(JSON.stringify(t));
            console.log("Now_Array_Size " + trajectory.length);
            console.log(t);

            // }
            // stack 滿了 傳送 db

            if (trajectory.length >= 3) { // 存放 超過 n 筆，資料寫入ＤＢ
                var ajax_data = ajax_log("yan", trajectory);
                console.log("Ajax to DB => " + ajax_data);

                if (ajax_data > 0) {
                    trajectory = new Array();
                    console.log("清除 Array");
                }

            }


            trajectory_count = trajectory_count + 1;
            console.log("累積筆數： " + trajectory_count);
            console.log("------------------------------------------------");
        }
    });// key


    // 圖片移動是否超出界線
    function move(
        direction, photo_vertical, photo_horizontal, all_map_vertical_length, all_map_horizontal_length,
        photo_block_vertical_height, photo_block_horizontal_width
    ) {
        var coordinate = new Array();
        // 紀錄原座標
        coordinate["old_vertical"] = photo_vertical;
        coordinate["old_horizontal"] = photo_horizontal;
        // 初始新座標
        coordinate["new_vertical"] = photo_vertical;
        coordinate["new_horizontal"] = photo_horizontal;

        var photo_vertical_range =
            photo_coordinate(coordinate["new_vertical"], photo_block_vertical_height, all_map_vertical_length);
        var photo_horizontal_range =
            photo_coordinate(coordinate["new_horizontal"], photo_block_horizontal_width, all_map_horizontal_length);

        switch (direction) {
            case "left":
                if (photo_horizontal_range["start"] > 0) { // 防止超過界線
                    coordinate["new_horizontal"] = photo_horizontal - 1; // 陣列向左移動
                    coordinate["place_direction"] = "left";
                } else {
                    coordinate = null; // 地圖邊界外設為空值
                }
                break;
            case "top":
                if (photo_vertical_range["start"] > 0) { // 防止超過界線
                    coordinate["new_vertical"] = photo_vertical - 1;// 陣列向上移動
                    coordinate["place_direction"] = "top";
                } else {
                    coordinate = null; // 地圖邊界外設為空值
                }
                break;
            case"right":

                if (photo_horizontal_range["end"] < all_map_horizontal_length - 1) { // 防止超過界線
                    coordinate["new_horizontal"] = photo_horizontal + 1;// 陣列向右移動
                    coordinate["place_direction"] = "right";
                } else {
                    coordinate = null; // 地圖邊界外設為空值
                }
                break;
            case"down":
                if (photo_vertical_range["end"] < all_map_vertical_length - 1) { // 防止超過界線
                    coordinate ["new_vertical"] = photo_vertical + 1;// 陣列向下移動
                    coordinate ["place_direction"] = "down";
                } else {
                    coordinate = null; // 地圖邊界外設為空值
                }
                break;
        }//switch

        return coordinate;

    } // move

    // 判斷是否通行
    function pass(
        map, new_vertical, new_horizontal, old_vertical, old_horizontal,
        photo_block_vertical_height, photo_block_horizontal_width,
        all_map_vertical_length, all_map_horizontal_length
    ) {
        var now_vertical = new_vertical;
        var now_horizontal = new_horizontal;

        var photo_vertical_range =
            photo_coordinate(new_vertical, photo_block_vertical_height, all_map_vertical_length);
        var photo_horizontal_range =
            photo_coordinate(new_horizontal, photo_block_horizontal_width, all_map_horizontal_length);

        var display_inline = 0;
        trajectory_status = "pass";
        for (var v = photo_vertical_range["start"]; v <= photo_vertical_range["end"]; v++) {
            for (var h = photo_horizontal_range["start"]; h <= photo_horizontal_range["end"]; h++) {

                if (map[v][h] != 0) { // 不可通行
                    // 存放未移動舊座標位置
                    trajectory_status = "obstacle";
                    now_vertical = old_vertical;
                    now_horizontal = old_horizontal;
                    display_inline = character(v, h);

                    break;
                }


                if (display_inline != 1) {

                    $("#dialgo").css("display", "none");

                }

            }
        }
        return {"now_vertical": now_vertical, "now_horizontal": now_horizontal};
    }


    // 計算圖片四個角座標
    function photo_coordinate(photo_center_point, photo_block_num, map_length) {
        //
        var photo_start_range = photo_center_point - (Math.floor(photo_block_num / 2));
        // 修正不超過邊界
        if (photo_start_range < 0) {
            photo_start_range = 0;
        }
        var photo_end_range = photo_start_range + photo_block_num - 1;
        if (photo_end_range >= map_length) {
            photo_start_range = map_length - photo_block_num;
            photo_end_range = photo_start_range + photo_block_num - 1;
        }

        return {"start": photo_start_range, "end": photo_end_range};
    }

    // 繪製地圖
    function draw_print(
        map,
        photo_vertical, photo_horizontal,
        all_map_vertical_length, all_map_horizontal_length,
        show_map_vertical_length, show_map_horizontal_length,
        block_vertical_height, block_horizontal_width
    ) {
        // 計算顯示地圖起始坐標和結束座標
        var vertical_range = Math.floor(show_map_vertical_length / 2);
        var horizontal_range = Math.floor(show_map_horizontal_length / 2);
        //
        var map_vertical_start = photo_vertical - vertical_range;
        var map_horizontal_start = photo_horizontal - horizontal_range;
        // 上面
        if (map_vertical_start < 0) {
            map_vertical_start = 0;
        }
        // 下面
        if (map_vertical_start > all_map_vertical_length - show_map_vertical_length) {
            map_vertical_start = all_map_vertical_length - show_map_vertical_length;
        }
        // 左面
        if (map_horizontal_start < 0) {
            map_horizontal_start = 0;
        }
        // 右面
        if (map_horizontal_start > all_map_horizontal_length - show_map_horizontal_length) {// 右面
            map_horizontal_start = all_map_horizontal_length - show_map_horizontal_length;
        }
        //

        // var map_vertical_end = map_vertical_start + show_map_vertical_length - 1;
        // var map_horizontal_end = map_horizontal_start + show_map_horizontal_length - 1;
        //


        ctx.drawImage(
            imageObj,
            map_horizontal_start * block_horizontal_width, map_vertical_start * block_vertical_height,
            show_map_horizontal_length * block_horizontal_width, show_map_vertical_length * block_vertical_height,
            0, 0,
            show_map_horizontal_length * block_horizontal_width, show_map_vertical_length * block_vertical_height);

        return {
            "map_vertical_start": map_vertical_start,
            "map_horizontal_start": map_horizontal_start,
            "vertical_range": vertical_range,
            "horizontal_range": horizontal_range,
            "map_vertical": all_map_vertical_length,
            "map_horizontal": all_map_horizontal_length
        };
    }

    // 移動圖片
    function show_photo_move(
        photo_center_vertical, photo_center_horizontal,
        photo_block_vertical_height, photo_block_horizontal_width,
        all_map_vertical_length, all_map_horizontal_length,
        map_vertical_start, map_horizontal_start,
        direction) {
        console.log(direction);

        var photo_vertical = photo_coordinate(photo_center_vertical, photo_block_vertical_height, all_map_vertical_length);
        var photo_horizontal = photo_coordinate(photo_center_horizontal, photo_block_horizontal_width, all_map_horizontal_length);

        var top_range = photo_vertical["start"] - Math.abs(map_vertical_start);
        var left_range = photo_horizontal["start"] - Math.abs(map_horizontal_start);
        var w = parseInt(left_range * block_horizontal_width) + parseInt(meun_width);

        $("#start,#top,#down,#left,#right").css("top", top_range * block_vertical_height);
        $("#start,#top,#down,#left,#right").css("left", w);
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

<script>
    // 解決圖片載入問題，
    window.onload = function () {
        if (location.href.indexOf("?xyz=") < 0) {
            location.href = location.href + "?xyz=" + Math.random();
        }
    }
</script>


<script>


    // 當網頁關閉 或 重新整理網頁
    $(window).bind('beforeunload', function (e) {
        if (isChange || $(".editing").get().length > 0) {


            // trajectory = ajax_log("yan_end", trajectory);
            //
            // $.get("php/write_db_log.php", {
            //     id: "yanyna_end",
            //     trajectory: JSON.stringify(trajectory),
            //     trajectory_count: trajectory_count
            // }, function (data) {
            //     console.log(data);
            // });
            // // console.log(JSON.stringify(trajectory));
            // trajectory = new Array();
            return '(((((((((★資料尚未存檔，確定是否要離開？★)))))))))';
        }
    });

</script>


<script>
    // ajax 寫入db

    function ajax_log(id, trajectory_log) {
        var trajectory_count = 0;


        $.ajax({
            type: "GET",
            url: "php/write_db_log.php",
            async: false,
            data: {
                id: id,
                trajectory: JSON.stringify(trajectory_log)
            },
            dataType: "json",
            cache: false,
            success: function (data) {


                trajectory_count = JSON.parse(data);
                console.log("---------------> " + trajectory_count);
            }
            // ,
            // error: function (e) {
            //     console.log(e);
            // }
        });
        return trajectory_count;

    }


</script>

</html>
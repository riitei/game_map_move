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

        .dialog {
            top: 100px;
            left: 100px;
            position: absolute;
            z-index: 20;
            background: lightskyblue;
            height: 100px;
            width: 400px;
            display: inline;
        }

        .example {
            top: 50px;
            left: 100px;

            position: absolute;
            z-index: 100;

            background: white;
            width: 1100px;
            height: 700px;
            overflow: hidden;

            display: none;

        }

        #drag1 {
            position: absolute;
            height: 36px;
            width: 400px;
            margin: 10px;
            padding: 2px;
            border: 1px solid black;
            z-index: 150;
            top: 100px;
        }

        #drag2 {
            position: absolute;
            z-index: 150;
            height: 36px;
            width: 400px;
            margin: 10px;
            padding: 2px;
            border: 1px solid black;
            top: 174px;

        }

        #drag3 {
            position: absolute;
            z-index: 150;
            height: 36px;
            width: 400px;
            margin: 10px;
            padding: 2px;
            border: 1px solid black;
            top: 250px;

        }

        #drag4 {
            position: absolute;
            z-index: 150;
            height: 36px;
            width: 400px;
            margin: 10px;
            padding: 2px;
            border: 1px solid black;
            top: 327px;
        }

        #drag5 {
            position: absolute;
            z-index: 150;
            height: 36px;
            width: 400px;
            margin: 10px;
            padding: 2px;
            border: 1px solid black;
            top: 400px;
        }

        #drag17, #drag18, #drag19, #drag20, #drag21, #drag22, #drag23, #drag24 {
            height: 36px;
            width: 450px;
            /*margin: 10px;*/
            /*padding: 2px;*/
            border: 1px solid black;
            top: 200px;

        }

        #left_topic {
            position: absolute;
            float: left;
            z-index: 100;
        }

        #submitcode1 {
            /*background: red;*/
            float: right;
        }

        #right_topic {
            position: absolute;
            z-index: 150;
            /*width: 500px;*/
            /*height: 500px;*/
            /*background: #0000FF;*/
            float: left;
            margin-left: 600px;
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


    <div id="dialog" class="example">

        <div id="left_topic">
            <img src="img/topic.png"><br>
            <button id="submitcode1" onclick="code1submit()">submit</button>
        </div>

        <div id="drag1" class="draggable-droppable"></div>
        <div id="drag2" class="draggable-droppable"></div>
        <div id="drag3" class="draggable-droppable"></div>
        <div id="drag4" class="draggable-droppable"></div>
        <div id="drag5" class="draggable-droppable"></div>


        <div id="right_topic">
            <h4>請完成右邊的Class Example。</h4>

            <h4>
                <div id="drag17" class="draggable-droppable">
                    <img src="img/code1.png" id="code1">
                    code1_and03
                </div>
            </h4>
            <h4>
                <div id="drag18" class="draggable-droppable">
                    <img src="img/code2.png" id="code2">code2_and02
                </div>
            </h4>
            <h4>
                <div id="drag19" class="draggable-droppable">
                    <img src="img/code3.png" id="code3">code3_and05
                </div>
            </h4>
            <h4>
                <div id="drag20" class="draggable-droppable">
                    <img src="img/code4.png" id="code4">code4
                </div>
            </h4>
            <h4>
                <div id="drag21" class="draggable-droppable">
                    <img src="img/code5.png" id="code5">code5_ans04
                </div>
            </h4>
            <h4>
                <div id="drag22" class="draggable-droppable">
                    <img src="img/code6.png" id="code6">code6_ans01
                </div>
            </h4>
            <h4>
                <div id="drag23" class="draggable-droppable">
                    <img src="img/code7.png" id="code7">code7
                </div>
            </h4>
            <h4>
                <div id="drag24" class="draggable-droppable">
                    <img src="img/code8.png" id="code8">code8
                </div>
            </h4>
        </div>
        <!--    </div>-->
    </div>
</div>

</body>

<script type="text/javascript">

    // $(function () {
    var map = <?=json_encode($map)?>;
    var all_map_vertical_length = JSON.parse(<?=$height?>);
    var all_map_horizontal_length = JSON.parse(<?=$width?>);
    var show_map_vertical_length = 50; // 顯示垂直長度
    var show_map_horizontal_length = 50; // 顯示水平長度


    // 圖片 中心點
    var photo_center_vertical = 50;//3 圖片初始位置 陣列 欄
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

    console.log(meun_width + map_width);

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
    // // 計算顯示地圖起始坐標和結束座標
    // var vertical_range = Math.floor(show_map_vertical_length / 2);
    // var horizontal_range = Math.floor(show_map_horizontal_length / 2);
    // //
    // var map_vertical_start = photo_center_vertical - vertical_range;
    // var map_horizontal_start = photo_center_horizontal - horizontal_range;
    // // 上面
    // if (map_vertical_start < 0) {
    //     map_vertical_start = 0;
    // }
    // // 下面
    // if (map_vertical_start > all_map_vertical_length - show_map_vertical_length) {
    //     map_vertical_start = all_map_vertical_length - show_map_vertical_length;
    // }
    // // 左面
    // if (map_horizontal_start < 0) {
    //     map_horizontal_start = 0;
    // }
    // // 右面
    // if (map_horizontal_start > all_map_horizontal_length - show_map_horizontal_length) {// 右面
    //     map_horizontal_start = all_map_horizontal_length - show_map_horizontal_length;
    // }
    // //
    //
    //
    // ctx.drawImage(
    //     imageObj,
    //     map_horizontal_start * block_horizontal_width, map_vertical_start * block_vertical_height,
    //     show_map_horizontal_length * block_horizontal_width, show_map_vertical_length * block_vertical_height,
    //     0, 0,
    //     show_map_horizontal_length * block_horizontal_width, show_map_vertical_length * block_vertical_height);

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
    console.log("yan");
    // });


    // var reset_count = 0;
    //
    // if (reset_count < 1) {
    //     reset_count = reset_count + 1;
    //     history.go(0);
    // }

    // 鍵盤出發圖片在地圖移動方向
    $(document).keydown(function (event) {
        //
        var move_place;
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
        for (var v = photo_vertical_range["start"]; v <= photo_vertical_range["end"]; v++) {
            for (var h = photo_horizontal_range["start"]; h <= photo_horizontal_range["end"]; h++) {


                // $("#dialog").css("display", "none");
                console.log(v + "," + h);


                if (map[v][h] > 1) { // 不可通行
                    // 存放未移動舊座標位置
                    now_vertical = old_vertical;
                    now_horizontal = old_horizontal;
                    break;
                }
                if (74 <= v && v <= 74 && 75 <= h && h <= 75) {
                    console.log(">>>>>>>>>>>>> in");
                    // 存放未移動舊座標位置

                    console.log("1=> " + v + "," + h);
                    // console.log("1=> " + photo_horizontal_range["start"] + "," + photo_horizontal_range["end"]);
                    // dialog＿message(photo_vertical_range["start"], photo_vertical_range["end"],
                    //     photo_horizontal_range["start"], photo_horizontal_range["end"]);
                    // break;
                    // $("#dialog").css("display", "inline");
                    now_vertical = old_vertical;
                    now_horizontal = old_horizontal;
                    display_inline++;
                }
                if (display_inline == 1) {
                    $("#dialog").css("display", "inline");
                } else {
                    $("#dialog").css("display", "none");
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

    function dialog＿message(photo_vertical_start, photo_vertical_end,
                            photo_horizontal_start, photo_horizontal_end) {

        // $("#dialog").empty();
        // $("#dialog").css("display", "inline");

        // $.post("php/dialog.php", {
        //     vertical_start: photo_vertical_start,
        //     vertical_end: photo_vertical_end,
        //     horizontal_start: photo_horizontal_start,
        //     horizontal_end: photo_horizontal_end
        // }, function (data) {
        //
        //     $("#dialog").append(data);
        //     $("#dialog").css("display", "inline")
        // });

    }
</script>

<script src="/v08_1_map_move_dialog/js/drag.js"></script>
<script src="/v08_1_map_move_dialog/js/submit.js"></script>
<script>
    // 解決圖片載入問題，
    window.onload = function () {
        if (location.href.indexOf("?xyz=") < 0) {
            location.href = location.href + "?xyz=" + Math.random();
        }
    }</script>

</html>
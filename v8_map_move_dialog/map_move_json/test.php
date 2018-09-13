<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/8/14
 * Time: 14:38
 */


$file_path = $_SERVER["DOCUMENT_ROOT"] . "v8_map_move_dialgo/map_move_json/dialgo.json";

try {
    $json = json_decode(file_get_contents($file_path), true);
    $height = $json["height"];
//    echo $json["height"] . "<br>"; // 高(垂直)共有n區塊 10
    $width = $json["width"];
//    echo $json["width"] . "<br>"; // 寬(水平)共有n區塊 20
    $tileheight = $json["tileheight"];
//    echo $json["tileheight"] . "<br>"; // 區塊的 高(垂直) px 20
    $tilewidth = $json["tilewidth"];
//    echo $json["tilewidth"] . "<br>"; // 區塊的 寬(水平) px 20
//    echo "<br>";
    foreach ($json["layers"] as $key => $value) {
//        echo count($value["data"]) . "<br>";
        if ($value["name"] == "obstacle") {
            $map = array_chunk($value["data"], $value["width"]);// 一維 轉 二維

//            for ($i = 0; $i < count($map); $i++) {
//                for ($j = 0; $j < count($map[$i]); $j++) {
//                    echo $map[$i][$j] . ",";
//                }
//                echo "<br>";
//            }
        }
        if ($value["name"] == "character01") {
            $character01 = array_chunk($value["data"], $value["width"]);
        }

    }
} catch (Exception $e) {
    echo $e;
}


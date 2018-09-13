<?php
include "DBConnection.php";
ini_set('display_errors', 'on');

/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/6/11
 * Time: 09:58
 */
// $dialgo 連接資料庫需要改寫，座標＝角色 => 角色＝對話
//$dialgo = array();
// $dialgo[vertical][horizontal][對話內容次數];
//$dialgo[5][1][0] = "yan";
//$dialgo[5][1][1] = "chongqing";
//$dialgo[1][3][0] = "ting";
//$dialgo[1][3][1] = "taipei";
//
//$vertical = $_POST['vertical'];
//$horizontal = $_POST['horizontal'];
//$vertical =5;
//$horizontal=1;

//foreach($dialgo[$vertical][$horizontal] as $key => $value){
//    echo $key." ".$value."<br>";
//}
// array or db 轉成 json
//$json = json_encode($dialgo[$vertical][$horizontal],true);
//
//echo $json;


$sql = "SELECT message 
FROM game_map_move.dialgo 
where 
vertical_start = " . $_POST["vertical_end"] . " or vertical_end = " . $_POST["vertical_start"] . "
and horizontal_start = " . $_POST["horizontal_start"] . " or horizontal_end= " . $_POST["horizontal_end"] . ";";

//echo $sql;
$data = DBConnection::PDO()->query($sql)->fetch();
echo $data["message"];



// console.log(photo_vertical_start + "," + photo_vertical_end);
// console.log(photo_horizontal_start + "," + photo_horizontal_end)


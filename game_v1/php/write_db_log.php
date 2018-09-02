<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/9/1
 * Time: 16:41
 */

include "DBConnection.php";


//echo "yan ting <br>";
$id = $_GET['id'];
$data = json_decode($_GET['trajectory']);

//$myfile = fopen("yan.txt", "w") or die("Unable to open file!");
//fwrite($myfile, $json);
//fclose($myfile);

//print_r($data[0]);

for ($i = 0; $i < count($data); $i++) {
    $temp = json_decode($data[$i], true);
//    echo $temp['trajectory_date'];


    $sql =
        "INSERT INTO `Log`( `student`, `trajectory_date`, `trajectory_coordinate`, `trajectory_status`)VALUES (
        '" . $id . "',
        '" . $temp['trajectory_date'] . "',
        '" . $temp['trajectory_coordinate'] . "',
        '" . $temp['trajectory_status'] . "');";
    $result = DBConnection::PDO()->prepare($sql);
    $result->execute();

}



//for ($i = 0; $i < count($data); $i++) {
//    echo $data[$i] . '<br>';
//}
//    echo '----------<br>';
//    $sql =
//        "INSERT INTO `Log`( `student`, `trajectory_date`, `trajectory_coordinate`, `trajectory_status`)VALUES (
//        '" . $id . "',
//        '" . $json['trajectory_date'][$i] . "',
//        '" . $json['trajectory_coordinate'][$i] . "',
//        '" . $json['trajectory_status'][$i] . "');";
//    fwrite($myfile, $sql);
//




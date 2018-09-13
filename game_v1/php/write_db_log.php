<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/9/1
 * Time: 16:41
 */

include "DBConnection.php";


//echo "yan ting <br>";
$id = $_POST['id'];
echo $_POST['trajectory'];
$data = json_decode($_GET['trajectory']);

for ($i = 0; $i < count($data); $i++) {
    $temp = json_decode($data[$i], true);

    try {
        $sql =
            "INSERT INTO `Log`( `student`, `trajectory_date`, `trajectory_coordinate`, `trajectory_status`)VALUES (
        '" . $id . "',
        '" . $temp['trajectory_date'] . "',
        '" . $temp['trajectory_coordinate'] . "',
        '" . $temp['trajectory_status'] . "');";
        $result = DBConnection::PDO()->prepare($sql);
        $result->execute();
//        $run_result = 1;
    } catch (PDOException $e) {
//        $run_result = 0;
        // 紀錄PDOException錯誤訊息
        $myfile = fopen("no_write_db.json", "a") or die("Unable to open file!");
        fwrite($myfile, $data[$i]);
        fclose($myfile);
        //
        // DB寫入失敗寫入server
        $error_file = fopen("pdo_error.txt", "a") or die("Unable to open file!");
        fwrite($error_file, $e);
        fclose($error_file);
    }
}


//echo ;
echo count($data);


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




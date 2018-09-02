<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/8/23
 * Time: 16:05
 */

include "DBConnection.php";

//try{
//    $_POST['fraction']
    $sql ="INSERT INTO `topic`(`fraction`) VALUES (".$_POST['fraction'].");";
    $result = DBConnection::PDO()->prepare($sql);
    $result->execute();

//    echo $_POST['fraction'] ;
echo "yan";
//}catch (PDOException $e){
//    echo $e;
//}
<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/9/1
 * Time: 22:29
 */


$data = "{\"trajectory_date\":\"2018-8-1 22:29:0\",\"trajectory_coordinate\":\"51,80\",\"trajectory_status\":\"pass\"}";

$data = json_decode($data,true);
//print_r($data);



echo $data['trajectory_date'];


//foreach ($data as $key => $value){
//
//    echo  $key." => ".$value.'<br><br>';
//
//}
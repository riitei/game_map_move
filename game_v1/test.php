<?php
/**
 * Created by PhpStorm.
 * User: riitei
 * Date: 2018/9/11
 * Time: 15:25
 */
$mess = array();
$mess["Character_01"]["order"] = 1;
$mess["Character_01"]["dialgo"]["a"] = "yan";
$mess["Character_01"]["dialgo"]["b"] = "";
$mess["Character_01"]["vertical_start"] = 74;
$mess["Character_01"]["vertical_end"] = 74;
$mess["Character_01"]["horizontal_start"] = 75;
$mess["Character_01"]["horizontal_end"] = 75;
$mess["Character_02"] = "ting";
$mess["Character_03"] = "yanyan";
//
//foreach ($mess as $key =>$value){
//    echo $key.$value.'<br>';
//}

echo json_encode($mess);


echo '<br><br>';
echo "<iframe src='topic/index.html' width='1400px' height='900px' scrolling='no' frameborder='0'></iframe>";



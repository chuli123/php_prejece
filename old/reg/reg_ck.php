<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/22
 * Time: 15:48
 */
include "../common/conn.class.php";
$postData = file_get_contents('php://input');
if(!empty($postData)){
    $sql = "SELECT id FROM tb_member WHERE username = '".$postData."'";
    $res = $connect-> getRowsNum($sql);
    $arr[] = '';
    if($res == 0){
        $arr['code'] = 1;
    }else{
        $arr['code'] = 0;
    }
    $output[] = $arr;
    echo json_encode($output);
}else{
    $arr['code'] = 1;
    $output[] = $arr;
    echo json_encode($output);
}
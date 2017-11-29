<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/22
 * Time: 11:17
 */
include "../common/conn.class.php";
$postData = file_get_contents('php://input');
$data = json_decode($postData,true);
if(!empty($data)){
    $sql = "SELECT password FROM tb_member WHERE username = '".$data['name']."'";
    $result = $connect -> getRowsRst($sql);
    $arr [] = '';
    if($result){
        if($result['password']==$data['password']){
            $arr['msg'] = "登录成功";
            $arr['code'] = 1;
        }
    }else{
        $arr['msg'] = "该用户名不存在";
        $arr['code'] = 0;
    }

    $output[] = $arr;
    echo json_encode($output);
}
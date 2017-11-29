<?php
include "../common/conn.class.php";
$postData = file_get_contents('php://input');
$data = json_decode($postData,true);
if(!empty($data)){
    $sql = "INSERT INTO tb_member(username,password,email,question,answer,realname,birthday,telephone,qq) VALUES('".$data['name']."','".$data['password']."','".$data['email']."','".$data['question']."','".$data['answer']."','".$data['realname']."','".$data['birthday']."','".$data['telephone']."','".$data['qq']."') ";
    $num = $connect -> uidRst($sql);
    $arr[] = '';
    if($num = 1){
        $arr['code'] = 1;
        $arr['msg'] = "注册成功";
    }else{
        $arr['code'] = 0;
        $arr['msg'] = "注册失败";
    }
    $output[] = $arr;
    echo json_encode($output);
}

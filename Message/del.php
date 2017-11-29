<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 18:23
 */
require_once "../Common/Conn.class.php";
$data = $_POST;
$mysqli = new Db();
$sql = "delete from tb_message where id=".$data['id'];
$res = $mysqli->exec($sql);
if($res){
    echo json_encode(array('status'=>1,'result'=>'ok'));
}else{
    echo json_encode(array('status'=>0,'result'=>'error'));
}
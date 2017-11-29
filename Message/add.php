<?php
require_once "../Common/Conn.class.php";
$data = $_POST;
$mysqli = new Db();
if(empty($data['id'])){
    $sql = "insert into tb_message(user,title,content) values('".$data['user']."','".$data['title']."','".$data['content']."')";
}else{
    $sql = "update tb_message set user='".$data['user']."',title='".$data['title']."',content='".$data['content']."' where id=".$data['id'];
}
$res = $mysqli->exec($sql);
if($res){
    echo json_encode(array('status'=>1,'result'=>'ok'));
}else{
    echo json_encode(array('status'=>0,'result'=>'error'));
}
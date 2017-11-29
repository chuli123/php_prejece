<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/15
 * Time: 16:52
 */
require_once "../Common/Conn.class.php";
$data = $_POST;
$mysqli = new Db();
$sql = 'select * from tb_message where id='.$data['id'];
$res = $mysqli->getRow($sql);
$res['status'] = 1;
echo json_encode($res);
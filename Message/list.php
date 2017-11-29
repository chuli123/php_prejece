<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 18:15
 */
require_once "../Common/Conn.class.php";
$mysqli = new Db();
$sql = "select * from tb_message";
$res = $mysqli->getAll($sql);
echo json_encode($res);
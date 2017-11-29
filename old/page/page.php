<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/31
 * Time: 16:43
 */
include "../common/conn.class.php";
$postData = file_get_contents('php://input');
var_dump($postData);
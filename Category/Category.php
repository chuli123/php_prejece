<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 16:23
 * 无限级分类  利用递归函数：函数自身调用自身
 */
require_once "../Common/Conn.class.php";
function getList($pid=0,&$result=array(),$space=0){
    $space = $space+2;
    $mysqli = new Db();
    $sql = "select * from tp_deepcate where pid=$pid";
    $res = $mysqli::getAll($sql);
    foreach($res as $v){
        $v['catename'] = str_repeat('&nbsp;',$space).'|--|'.$v['catename'];
        $result[] = $v;
        getList($v['id'],$result,$space);
    }
    return $result;
}
function display($selected=1){
    $rs = getList();
    $str = '';
    $str.='<select name="cate">';
    foreach($rs as $v){
        $selectedStr ='';
        if($v['id'] == $selected){
            $selectedStr = $selected;
        }
        $str.="<option{$selectedStr}>{$v['catename']}</option>";
    }
    return $str.='</select>';
}
echo display();
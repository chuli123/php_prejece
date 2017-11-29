<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 15:38
 */
header("Content-type: text/html; charset=utf-8");
$file = $_FILES['filename'];
if($file['error']==0){
    if(is_uploaded_file($file[tmp_name])){
        if(file_exists("uploads/".$file['name'])){
            echo $file['name']."已存在";
        }else{
            move_uploaded_file($file['tmp_name'],"E:/wamp/www/module/uploads/".$file['name']);
            echo "文件存储在："."uploads/".$file['name'];
        }
    }else{
        echo "非法操作";
    }
}else{
    echo "上传错误";
}
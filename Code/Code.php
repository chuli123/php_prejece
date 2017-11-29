<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 17:23
 * 验证码  创建地图->添加字符串->增加干扰
 */
session_start();
header('content-type:image/png');
//创建底图
$img = imagecreatetruecolor(100,30);
$bgColor = imagecolorallocate($img,000,255,255);
imagefill($img,0,0,$bgColor);
$captch_code ='';
//字符串
for($i=0;$i<4;$i++){
    $fontSize = 6;
    $fontColor = imagecolorallocate($img,rand(0,150),rand(0,150),rand(0,150));
    $data = "abcdefghijklmnopqrstuvwsyz0123456789";
    $fontContent = substr($data,rand(0,strlen($data)),1);
    $captch_code.=$fontContent;
    $x = ($i*100/4)+ rand(5,10);
    $y = rand(5,10);
    imagestring($img,$fontSize,$x,$y,$fontContent,$fontColor);
}
$_SESSION['code'] = $captch_code;
//增加干扰元素
for($i=0;$i<200;$i++){
    $pointColor = imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));
    imagesetpixel($img,rand(1,99),rand(1,29),$pointColor);
}
for($i=0;$i<8;$i++){
    $lineColor = imagecolorallocate($img,rand(60,220),rand(60,220),rand(60,220));
    imageline($img,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$lineColor);
}
imagepng($img);
imagedestroy($img);

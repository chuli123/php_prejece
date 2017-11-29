<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10
 * 分页   $_SERVER['PHP_SELF'] 输出的是 /Page/Page.php
 */
require_once "../Common/Conn1.class.php";
//获取当前页码
$page= isset($_GET['p']) ? trim($_GET['p']) : 1;
//一页显示多少条数据
$pageSize = 3;
//显示页码的个数
//$showPage = 10;
$mysqli = new Db();
//查询数据
$sql = "select * from tp_test limit ".($page-1)*$pageSize .",".$pageSize; //注意：limit后面的空格
$res = $mysqli::getAll($sql);
echo "<table border=1 cellspacing=0 width=15%>";
echo "<tr><td>ID</td><td>名字</td><td>性别</td></tr>";
foreach($res as $row){
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['sex']}</td>";
    echo "<tr>";
}
//释放资源
$res->free();

//统计总共有多少条数据
$sql = "select COUNT(*) from tp_test";
$res = $mysqli::query($sql);
$num = $res->fetch_array();
//获取条数
$total = $num[0];
//计算总共多少页
$total_page = ceil($total/$pageSize);

$page_banner = "";
//计算偏移量
//$pageAffect = ($showPage-1)/2;

if($page>1){
    $page_banner = "<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
    $page_banner .= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."'>上一页</a>";
}

$start = 1;
$end = $total_page;
//if($total_page>$showPage){
//    if($page>$pageAffect+1){
//        $page_banner.="...";
//    }
//    if ($page>$pageAffect){
//        $start=$page-$pageAffect;
//        $end=$total_page>$page+$pageAffect?$page+$pageAffect:$total_page;
//    }else{
//        $start=1;
//        $end=$total_page>$showPage?$showPage:$total_page;
//    }
//    if ($page+$pageAffect>$total_page){
//        $start=$start-($page+$pageAffect-$end);
//    }
//}
for($i=$start;$i<=$end;$i++){
    $page_banner.="<a href='".$_SERVER['PHP_SELF']."?p=".($i)."'>{$i}</a>";
}

//if ($total_page>$showPage&&$total_page>$page+$pageAffect){
//    $page_banner.="...";
//}

if($page<$total_page){
    $page_banner .= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."'>下一页</a>";
    $page_banner .= "<a href='".$_SERVER['PHP_SELF']."?p=".$total_page."'>尾页</a>";
}
$page_banner.="共{$total_page}页";
$page_banner.="<form action='page.php' method='get'>";
$page_banner.="到第<input type='text'size='2'name='p'>页";
$page_banner.="<input type='submit'value='确定'>";
$page_banner.="</form>";
echo $page_banner;
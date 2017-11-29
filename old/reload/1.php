<?php 
header("Content-type: text/html; charset=utf-8");
// 包含数据库配置信息
include_once('../config.php');
// 接收数据
$paging = isset($_REQUEST['paging'])?$_REQUEST['paging']:'';
// $paging = 1;
$num = 15;//每页显示记录条数
$start_page = $num*($paging-1);// 每页第一条记录编号
// 用于返回数据
$return = array(); 
$data = array();
/* mysqli 面向对象 编程方式 */
// 1 . 创建数据库链接
$conn = new mysqli($servername,$username,$password,$database);
if ($conn->connect_error) {
    die("连接失败 : ".$conn->connect_error);
}
// echo "链接成功";
// 设置字符集（以防出错 每次都要写）
$conn->query("SET NAMES utf8");
// 2 . 数据操作
$sql = "SELECT * FROM mission_news order by id desc limit $start_page , $num;";
// $sql = "SELECT * FROM mission_news order by id desc limit 0 , 15;";
// 3 . 执行一条语句
$ret = $conn->query($sql);
// 4 . 循环获取每条记录
if ($ret->num_rows > 0) {
    while ($row = $ret->fetch_assoc()) { //将每条记录以 数组形式 返回
        // var_dump($row);
        // echo "id = ".$row['id']."  mid = ".$row['mid']."  context = ".$row['context']."<br>";
        $tmp = array();//临时数组整合信息 
        $tmp['id'] = $row['id'];
        $tmp['mid'] = $row['mid'];
        $tmp['context'] = $row['context'];
        $tmp['turn'] = $row['turn'];
        $tmp['created'] = $row['created'];
        // 临时数组 拼接到 返回的数组中
        $data[] = $tmp; // 自增
    }
    // 拼接返回数组
    $return['result'] = 1;
    $return['data'] = $data;
}
// 5 . 关闭数据库
$conn->close();
// 6 . 编码为json字符串返回
echo json_encode($return);
 ?>

作者：Alex_King
链接：http://www.jianshu.com/p/65c718093d44
來源：简书
著作权归作者所有。商业转载请联系作者获得授权，非商业转载请注明出处。
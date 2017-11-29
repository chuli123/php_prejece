<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/11
 * Time: 17:10
 */

class Db4{
    private $db_host = 'localhost';  //服务器地址
    private $db_user = 'root'; //用户名
    private $db_pwd = ''; //密码
    private $db_name = 'module'; //数据库名
    private $conn = ''; //数据库连接资源
    private $result = ''; //结果集
    private $msg = ''; //返回结果
    private $fields = ''; //返回字段
    private $fieldsNum = 0; //返回字段数
    private $rowsNum = 0; //返回结果数
    private $rowsRst = ''; //返回单条记录的字段数组
    private $fieldArray = array(); //返回字段数组
    private $rowsArray = array(); //返回结果数组

    public function __construct($db_host,$db_user,$db_pwd,$db_name){
        if($db_host!=''){
            $this->db_host = $db_host;
        }
        if($db_user!=''){
            $this->db_user = $db_user;
        }
        if($db_pwd!=''){
            $this->db_pwd = $db_pwd;
        }
        if($db_name!=''){
            $this->db_name = $db_name;
        }
        $this->init_conn();
    }

//  连接数据库
    public function init_conn(){
        $this->conn = new mysqli($this->db_host,$this->db_user,$this->db_pwd);
        $this->conn->select_db($this->db_name);
        mysqli_query($this->conn,"SET NAMES UTF8");
    }

    public function mysql_query_rst($sql){
        if($this->conn==''){
            $this->init_conn();
        }
        $this->result = mysqli_query($this->conn,$sql);
    }

//    获取记录中的行数
    public function getRowsNum($sql){
        $this->mysql_query_rst($sql);
        if(mysqli_errno($this->conn)==0){
            return mysqli_num_rows($this->result);
        }else{
            return '';
        }
    }

//    获取单条记录
    public function getRowsRst($sql){
        $this->mysql_query_rst($sql);
        if(mysqli_errno($this->conn)==0){
            $this->rowsRst = mysqli_fetch_array($this->result,MYSQLI_ASSOC);
            return $this->rowsRst;
        }else{
            return '';
        }
    }


//    获取多条记录
    public function getRowsArray($sql){
        $this->mysql_query_rst($sql);
        if(mysqli_errno($this->conn)==0){
            while($rows = mysqli_fetch_array($this->result,MYSQLI_ASSOC)){
                $this->rowsArray[] = $rows;
            }
            return $this->rowsArray;
        }else{
            return '';
        }
    }

//    数据库更新，修改，删除
    public function uidRst($sql){
        $this->mysql_query_rst($sql);
        $this->rowsNum = mysqli_affected_rows($this->conn);
        if(mysqli_errno($this->conn)==0){
            return $this->rowsNum;
        }else{
            return '';
        }
    }

//    释放结果集函数，将不再使用的数据删除，释放内存
    public function close_rst(){
        mysqli_free_result($this->result);
        $this->msg = '';
        $this->fieldsNum = 0;
        $this->rowsNum = 0;
        $this->fieldArray = '';
        $this->rowsArray = '';
    }

//    关闭数据库连接
    public function close_conn(){
        $this->close_rst();
        mysqli_close($this->conn);
        $this->conn = '';
    }
}
$connect = new Db4('localhost','root','','module');
?>
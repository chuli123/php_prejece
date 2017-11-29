<?php
class Db1{
    private $conn;
    private $db_host = 'localhost'; //服务器地址
    private $db_user = 'root'; //用户名
    private $db_pwd = ''; //密码
    private $db_name = 'module'; //数据库名

    public function __construct($db_host='',$db_user='root',$db_pwd='',$db_name='module')
    {
        if(!$db_host){
            $this->db_host = $db_host;
        }
        if(!$db_user){
            $this->db_user = $db_user;
        }
        if(!$db_pwd){
            $this->db_pwd = $db_pwd;
        }
        if(!$db_name){
            $this->db_name = $db_name;
        }
        $this->conn();
    }

    public function conn(){
        $this->conn = mysqli_connect($this->db_host,$this->db_user,$this->db_pwd,$this->db_name);
        if($this->conn->connect_error){
            die("连接出错".$this->conn->connect_error);
        }
        $this->conn->query("SET NAMES UTF8");
    }

    public function dql($sql){
        $result = $this->conn->query($sql) or die("数据查询失败".$this->conn->error);
        return $result;
    }

    public function dml($sql){
        $result = $this->conn->query($sql) or die("数据操作失败".$this->conn->error);
        if(!$result){
            echo "数据操作失败";
        }else{
            if($this->conn->affacted_rows>0){
                echo "操作成功！";
            }else{
                echo "0行数据受影响！";
            }
        }
        $this->conn->close;
    }
}


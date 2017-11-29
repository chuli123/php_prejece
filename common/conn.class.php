<?php
/**
 * Mysql类
 */
class Db{

    private static $link = null;//数据库连接
    private static $db_host = 'localhost'; //服务器地址
    private static $db_user = 'root'; //用户名
    private static $db_pwd = ''; //密码
    private static $db_name = 'module'; //数据库名

    /**
     * 构造方法
     */
    public function __construct(){

    }

    /**
     * 连接数据库
     * @return obj 资源对象
     */
    private static function conn(){
        if(self::$link === null){
            self::$link = new Mysqli(self::$db_host,self::$db_user,self::$db_pwd,self::$db_name);
            self::query("set names UTF8");//设置字符集
        }
        return self::$link;
    }

    /**
     * 执行一条sql语句
     * @param  str $sql 查询语句
     * @return obj      结果集对象
     */
    public static function query($sql){
        return self::conn()->query($sql);
    }

    /**
     * 获取多行数据
     * @param  str $sql 查询语句
     * @return arr      多行数据
     */
    public static function getAll($sql){
        $data = array();
        $res = self::query($sql);
        while($row = $res->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }

    /**
     * 获取一行数据
     * @param  str $row 查询语句
     * @return arr      单行数据
     */
    public static function getRow($sql){
        $res = self::query($sql);
        return $res->fetch_assoc();
    }

    /**
     * 获取单个结果
     * @param  str $sql 查询语句
     * @return str      单个结果
     */
    public static function getOne($sql){
        $res = self::query($sql);
        $data = $res->fetch_row();
        return $data[0];
    }

    /**
     * 插入/更新数据
     * @param  str $table  表名
     * @param  arr $data  插入/更新的数据
     * @param  str $act   insert/update
     * @param  str $where 更新条件
     * @return bool 插入/更新是否成功
     */
    public static function exec($sql){
        $result = self::conn()->query($sql) or die("数据操作失败".self::conn()->error);
        if(!$result){
            return 0;
        }else{
            if(self::conn()->affected_rows > 0){
                return 1;
            }else{
                return 2;
            }
        }
        self::close;
    }

    /**
     * 获取最近一次插入的主键值
     * @return int 主键
     */
    public static function getLastId(){
        return self::conn()->insert_id;
    }

    /**
     * 获取最近一次操作影响的行数
     * @return int 影响的行数
     */
    public static function getAffectedRows(){
        return self::conn()->affected_rows;
    }

    /**
     * 关闭数据库连接
     * @return bool 是否关闭
     */
    public static function close(){
        return self::conn()->close();
    }

}

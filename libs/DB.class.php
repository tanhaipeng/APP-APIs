<?php
class DB{
    // 保存类对象
    static private $_instance;
    static private $_connect;
    // 不允许外部创建
    private function __construct(){
        
    }
    
    // 公共方法
    static public function getInstance(){
        if(!self::$_instance instanceof self){
            self::$_instance=new self();
        }
        return self::$_instance;
    }
    
    public function connect($dbConfig=array()){
        if(!self::$_connect){ 
        self::$_connect=mysqli_connect($dbConfig['host'],$dbConfig['user'],$dbConfig['password']);
         if(!self::$_connect){
             // die('mysql connect error:'.mysqli_errno(self::$_connect));
             // 抛出异常
             throw new Exception(mysqli_errno(self::$_connect));
         }
         mysqli_select_db(self::$_connect,$dbConfig['database']);
         mysqli_query(self::$_connect,'set names utf8');
         return self::$_connect;
        }
    }
}
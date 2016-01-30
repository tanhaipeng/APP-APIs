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
    
    public function connect($dbConfig){
        if(!self::$_connect){ 
        self::$_connect=mysql_connect($dbConfig['host'],$dbConfig['user'],$dbConfig['password']);
         if(!self::$_connect){
             die('mysql connect error:'.mysql_errno(self::$_connect));
         }
         mysql_select_db($dbConfig['database'],self::$_connect);
         mysql_query('set names utf8',self::$_connect);
         return self::$_connect;
        }
    }
}
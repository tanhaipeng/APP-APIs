<?php
class DB{
    // ���������
    static private $_instance;
    static private $_connect;
    // �������ⲿ����
    private function __construct(){

    }
    
    // ��������
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
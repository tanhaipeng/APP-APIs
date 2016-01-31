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
    
    public function connect($dbConfig=array()){
        if(!self::$_connect){ 
        self::$_connect=mysqli_connect($dbConfig['host'],$dbConfig['user'],$dbConfig['password']);
         if(!self::$_connect){
             // die('mysql connect error:'.mysqli_errno(self::$_connect));
             // �׳��쳣
             throw new Exception(mysqli_errno(self::$_connect));
         }
         mysqli_select_db(self::$_connect,$dbConfig['database']);
         mysqli_query(self::$_connect,'set names utf8');
         return self::$_connect;
        }
    }
}
<?php
class Singleton{
    // ���������
    static private $_instance;
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
}

require_once 'libs/DB.class.php';
require_once 'config.php';
$db=DB::getInstance();
var_dump($db->connect($dbConfig));


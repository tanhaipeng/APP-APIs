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


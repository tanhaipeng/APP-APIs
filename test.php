<?php
class Singleton{
    // 保存类对象
    static private $_instance;
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
}


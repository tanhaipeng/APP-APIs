<?php
require_once 'libs/Common.class.php';
require_once 'libs/Response.class.php';
require_once 'libs/DB.class.php';

class error extends Common{
    public function index(){
        // app请求参数校验
        $this->check();
        
        $error=isset($_POST['error_log'])?$_POST['error_log']:'';
        if(!$error){
            response::getEncode(0,'logs empty','');
            exit();
        }
        
        $sql="insert into log(error) values('start error')";
        $connect=DB::getInstance()->connect($dbConfig);
        mysqli_query($connect, $sql);
        response::getEncode(0,'logs send success','');
        exit();
    }
}

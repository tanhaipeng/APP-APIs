<?php
/**
 * 处理接口公共业务
 */
require_once 'libs/Response.class.php';
require_once 'libs/DB.class.php';
    
class Common{
    public $params;
    public $app;
    
    public function check(){
        $this->params['app_id']=$appid=isset($_POST['app_id'])?$_POST['app_id']:'';
        $this->params['version_id']=$versionid=isset($_POST['version_id'])?$_POST['version_id']:'';
        $this->params['version_mini']=$versionmini=isset($_POST['version_mini'])?$_POST['version_mini']:'';
        $this->params['did']=$did=isset($_POST['did'])?$_POST['did']:'';
        $this->params['encrypt_did']=$encryptdid=isset($_POST['encrypt_did'])?$_POST['encrypt_did']:'';
        
        // 接口数据校验省略，实际使用时须加
        if(!is_numeric($appid)){
            response::getEncode(300,'params error','');
            exit();
        }
        
        // 判断APP是都要加密
        $this->app=$this->getApp($appid);
        if(!$this->app){
            response::getEncode(500,'params error','');
            exit();
        }
        /*
        if($encryptdid!=md5($did,$this->app['key'])){
            response::getEncode(500,'md5 error','');
            exit();
        }
        */

    }
    
    public function getApp($id) {
        global $dbConfig;
        $sql="select * from app where id={$id} and status=1 limit 1";
        $connect=DB::getInstance()->connect($dbConfig);
        return '111';
    }
    
    public function getversionUpgrade($appid){
        global $dbConfig;
        $sql="select * from update where 1=1";
        $connect=DB::getInstance()->connect($dbConfig);
        $result=mysqli_query($connect,$sql);
        return mysqli_fetch_assoc($result);
    }
}
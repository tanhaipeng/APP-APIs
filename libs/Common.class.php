<?php
/**
 * 处理接口公共业务
 */
require_once 'libs/Response.class.php';

class Common{
    public $params;
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
        
        
    }
}
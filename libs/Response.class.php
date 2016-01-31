<?php

class response{

    /**
     * 按json输出通信数据
     * @param int $code 状态码
     * @param string $message 提示信息
     * @param array $data 数据
     */
    public static function jsonEncode($code,$message="",$data=array()){
        if(!is_numeric($code)){
            exit;
        }
        
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        echo json_encode($result);
    }
    
    /**
     * 按xml输出通信数据
     * @param int $code
     * @param string $message
     * @param array $data
     */
    public static function xmlEncode($code,$message="",$data=array()){
        if(!is_numeric($code)){
            exit;
        }
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        header("Content-type:text/xml");
        $xml="<?xml version='1.0' encoding='UTF-8'?>";
        $xml.="<root>";
        $xml.=self::array2xml($result);
        $xml.="</root>";
        echo $xml;
    }
    
    /**
     * array转换为xml结点
     * @param array $data
     * return string
     */
    public static function array2xml($data){
        $xml="";
        foreach ($data as $key=>$value){
            // key为数字
            if(is_numeric($key)){
                $attr=" id='{$key}'";
                $key="item";
            }else{
                $attr="";
            }
            
            $xml.="<{$key}{$attr}>";
            $xml.=is_array($value)?self::array2xml($value):$value;
            $xml.="</{$key}>";
        }
        return $xml;
    }
    
    /**
     * 综合方式输出通信方式
     * @param int $code
     * @param string $message
     * @param array $data
     * @param string $type
     */
    public static function getEncode($code,$message="",$data=array()){
        $type=isset($_GET['format'])?$_GET['format']:'json';
        if(!is_numeric($code)){
            exit;
        }
        $result=array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        if($type=='json'){
            self::jsonEncode($code,$message,$data);
        }else{
            self::xmlEncode($code,$message,$data);
        } 
    }
}
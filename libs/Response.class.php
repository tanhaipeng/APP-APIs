<?php

class response{

    /**
     * ��json���ͨ������
     * @param int $code ״̬��
     * @param string $message ��ʾ��Ϣ
     * @param array $data ����
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
     * ��xml���ͨ������
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
     * arrayת��Ϊxml���
     * @param array $data
     * return string
     */
    public static function array2xml($data){
        $xml="";
        foreach ($data as $key=>$value){
            // keyΪ����
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
     * �ۺϷ�ʽ���ͨ�ŷ�ʽ
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
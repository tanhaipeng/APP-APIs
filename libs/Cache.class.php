<?php
/***
 * static file Cache class
 * @author tanhaipeng
 */
class Cache{
    private $_dir;
    const EXT='.cache';
    /**
     * ���캯��
     */
    public function __construct(){
        $this->_dir=dirname(dirname(__FILE__)).'/cache/';
    }
    
    /**
     * �����������
     * ֻ��key����ȡ����
     * ��(key,value):��value=''ɾ�����棬�������軺��
     * @param unknown $key
     * @param string $value
     * @param string $path
     * @return number|boolean
     */
    public function cacheData($key,$value='',$cacheTime=0){
        $filename=$this->_dir.$key.self::EXT;
        // valueֵд�뻺��
        if($value!==''){
            if(is_null($value)){
                return @unlink($filename);
            }
            // ��ȡ�ļ�Ŀ¼
            $dir=dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            // file_put_contentsֻ��дstring
            $cacheTime=sprintf('%011d',$cacheTime);
            return file_put_contents($filename, $cacheTime.json_encode($value));
            
        }
        
        if(!is_file($filename)){
            return false;
        }else{
            $content=file_get_contents($filename,true);
            $cacheTime=(int)substr($content, 0,11);
            // compare time
            $value=substr($content,11);
            if($cacheTime!=0 && $cacheTime+filemtime($filename)<time()){
                @unlink($filename);
                return false;
            }else{
                return json_decode($value,true);
            }
        }
    }
}
<?php
/***
 * static file Cache class
 * @author tanhaipeng
 */
class Cache{
    private $_dir;
    const EXT='.cache';
    /**
     * 构造函数
     */
    public function __construct(){
        $this->_dir=dirname(dirname(__FILE__)).'/cache/';
    }
    
    /**
     * 缓存操作函数
     * 只传key：获取缓存
     * 传(key,value):若value=''删除缓存，否则重设缓存
     * @param unknown $key
     * @param string $value
     * @param string $path
     * @return number|boolean
     */
    public function cacheData($key,$value='',$cacheTime=0){
        $filename=$this->_dir.$key.self::EXT;
        // value值写入缓存
        if($value!==''){
            if(is_null($value)){
                return @unlink($filename);
            }
            // 获取文件目录
            $dir=dirname($filename);
            if(!is_dir($dir)){
                mkdir($dir,0777);
            }
            // file_put_contents只能写string
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
<?php
require_once 'libs/DB.class.php';
require_once 'libs/Cache.class.php';
require_once 'config.php';

class firstpage{
    private $_page;
    private $_pagesize;
    public function __construct(){
        $this->_page=isset($_GET['page'])?$_GET['page']:1;
        $this->_pagesize=isset($_GET['pagesize'])?$_GET['pagesize']:10;
    }
    public function get(){
        if(!is_numeric($this->_page)||!is_numeric($this->_pagesize)){
            response::getEncode(100,'request error','');
            exit();
        }
        // get from cache
        $cache=new Cache();
        $rdata=array();
        
        // 存在缓存时，直接获取缓存并返回
        if($rdata=$cache->cacheData('index_cache_'.$this->_page.'-'.$this->_pagesize)){
            response::getEncode(0,'request success',$rdata);
            exit();
        }
        
        // 否则读取数据库，并且更新缓存
        global $dbConfig;
        $offset=($this->_page-1)*$this->_pagesize;
        $sql="select * from mall where status=1 order by price limit ".$offset.','.$this->_pagesize;
        // 异常接收
        try{
            $conn=DB::getInstance()->connect($dbConfig);
        }catch(Exception $e){
            // $e->getMessage()
            response::getEncode(400,'database connect error','');
            exit();
        }
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res)){
            $rdata[]=$row;
        }
        $cache->cacheData('index_cache_'.$this->_page.'-'.$this->_pagesize,$rdata,$cacheConfig['expiretime']);
        response::getEncode(0,'request success',$rdata);
        exit();
    }
}
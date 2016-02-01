<?php
require_once 'libs/DB.class.php';
require_once 'libs/Cache.class.php';
require_once 'config.php';

class firstpage{
    private $_page;
    private $_pagesize;
    private $_memcache;
    public function __construct(){
        $this->_page=isset($_GET['page'])?$_GET['page']:1;
        $this->_pagesize=isset($_GET['pagesize'])?$_GET['pagesize']:10;
        $this->_memcache=new Memcache();
    }
    public function get(){
        if(!is_numeric($this->_page)||!is_numeric($this->_pagesize)){
            response::getEncode(100,'request error','');
            exit();
        }
        // get from cache
        global $dbConfig;
        global $cacheConfig;
        $cache=new Cache();
        $rdata=array();
        
        // 存在缓存时，直接获取缓存并返回
        /*
        if($rdata=$cache->cacheData('index_cache_'.$this->_page.'-'.$this->_pagesize)){
            response::getEncode(0,'request success',$rdata);
            exit();
        }
        */
        
        // 使用memcache缓存
        $this->_memcache->connect($cacheConfig['host'],$cacheConfig['port']);
        if($rdata=$this->_memcache->get('index_cache_'.$this->_page.'-'.$this->_pagesize)){
            var_dump('get cache');
            response::getEncode(0,'request success',$rdata);
            exit();
        }
        
        // 否则读取数据库，并且更新缓存
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
        //$cache->cacheData('index_cache_'.$this->_page.'_'.$this->_pagesize,$rdata,$cacheConfig['expiretime']);
        $this->_memcache->add('index_cache_'.$this->_page.'-'.$this->_pagesize,$rdata);
        var_dump('set cache');
        response::getEncode(0,'request success',$rdata);
        exit();
    }
}
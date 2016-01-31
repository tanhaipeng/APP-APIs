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
        global $dbConfig;
        $offset=($this->_page-1)*$this->_pagesize;
        $sql="select * from mall where status=1 order by price limit ".$offset.','.$this->_pagesize;
        // Òì³£½ÓÊÕ
        try{
            $conn=DB::getInstance()->connect($dbConfig);
        }catch(Exception $e){
            // $e->getMessage()
            response::getEncode(400,'database connect error','');
            exit();
        }
        $res=mysqli_query($conn,$sql);
        $rdata=array();
        while($row=mysqli_fetch_assoc($res)){
            $rdata[]=$row;
        }
        response::getEncode(0,'request success',$rdata);
        exit();
    }
}
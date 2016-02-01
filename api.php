<?php
/**
 * get
 * http://***?type=firstpage&page=1&pagesize=10
 */

require_once 'Controllers/firstpage.class.php';
require_once 'Controllers/defaultpage.class.php';
require_once 'libs/Response.class.php';


// route
$type=isset($_GET['type'])?$_GET['type']:'default';
$cache=new Cache();
$cache->cacheData('sfdf',array(1,2,3),180);

switch ($type){
    case 'firstpage':
        $firstpage=new firstpage();
        return $firstpage->get();
        break;
    default:
        $res=new response();
        return response::getEncode(200,'request type error','');
        break;
}

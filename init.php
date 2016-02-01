<?php
require_once 'libs/Common.class.php';

class init extends Common{
    public function index(){
        $this->check();
        $getversionUpgrade=$this->getversionUpgrade($this->app['app_id']);
        if($getversionUpgrade){
            
        }
    }
}

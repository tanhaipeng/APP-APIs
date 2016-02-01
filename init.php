<?php
require_once 'libs/Common.class.php';

class init extends Common{
    public function index(){
        $this->check();
    }
}

$init=new init();
$init->check();

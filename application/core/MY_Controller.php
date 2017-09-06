<?php

class MY_Controller extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->base = $this->config->item("base_url");
        $this->unifyEntrance = $this->config->item('unifyEntrance');
        $this->logfile_suffix = '-'.date('Ymd',time()).'.log';
        if(!isset($_SESSION))
        {    
        	session_start();
        }
    }
}

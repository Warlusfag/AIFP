<?php
require_once "user_model.php";
require_once "associazione_model.php";
require_once "evento_model.php";
require_once "admin_model.php";
require_once 'funghi_model.php';
require_once 'sezione_model.php';

//limit constant
const limit_sez = 5;
const limit_events = 20;
const limit_session = 1000000;

class collection{
    
    protected $items;
    
    function __construct(){
        $this->items = array();
    }    

    public function additem($obj, $key) {
        if(isset($this->items[$key])){
            return false;
        }else{
            $this->items[$key] = $obj;
            return true;
        }
    }

    public function deleteitem($key) {
        if(!isset($this->items[$key])){
            return false;
        }else{
            unset($this->items[$key]);
            return true;
        }
    }

    public function getitem($key) {
        if(!isset($this->items[$key])){
            return false;
        }else{
            return $this->items[$key];
        }
    }
    public function count(){
        return count($this->items);
    }
}

class sezioni_collection extends collection{
    function __construct(){
        parent::__construct();
    }

}

class funghi_collection extends collection{
    function __construct(){
        parent::__construct();
    }

}

class news_collection extends collection{
    protected $is_load;
    function __construct(){
        parent::__construct();
        $this->is_load = false;
    }
    public function add_all_news($news){
        $this->items = array_merge($this->items, $news);
        $this->is_load();
    }
    public function get_all_news(){
        if($this->is_load){
            return $this->items;
        }
        return false;
    }
    public function is_load(){
        return $this->is_load;
    }

}
<?php
require_once "user_model.php";
require_once "associazione_model.php";
require_once "evento_model.php";
require_once "admin_model.php";
require_once 'funghi_model.php';
require_once 'sezione_model.php';
require_once 'piante_model.php';

//limit constant
const limit_sez = 5;
const limit_events = 20;
const limit_session = 1000000;

class collection{
    
    protected $items;
    protected $is_load;
    
    function __construct(){
        $this->items = array();
        $this->is_load = false;
    }    

    public function additem($obj, $key) {
        if(isset($this->items[$key])){
            $this->is_load = true;
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
            if($this->count() == 0){
                $this->is_load = false;                
            }
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
    public function erase(){
        if($this->count()>0){
            foreach(array_keys($this->items) as $key){
                unset($this->items[$key]);
            }
        }
    }
    public function updateitem($key, $obj){
        if(!isset($this->items[$key])){
            return false;
        }
        $this->items[$key] = $obj;
        return true;
    }
    
    public function is_load(){
        return $this->is_load;
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
class piante_collection extends collection{
    function __construct(){
        parent::__construct();
    }

}
class conv_collection extends collection {
    public $sezione;
    public $curr_page;
    
    function __construct(){
        parent:: __construct();
        $this->sezione = -1;
        $this->curr_page = 0;
    }    
    
}

class news_collection extends collection{
    
    function __construct(){
        parent::__construct();        
    }
    public function add_all_news($news){
        $this->items = array_merge($this->items, $news);
        $this->is_load = true;
    }
    public function get_all_news(){
        if($this->is_load){
            return $this->items;
        }
        return false;
    }
}
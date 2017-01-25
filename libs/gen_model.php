<?php

    require_once 'admin/db_interface.php';


class gen_model{
    
    public $conn;
    
    public $attributes;
    public $table_descr;
    public $err_descr;
    
    function __construct(){
        $this->conn = new db_interface();
        if(!$this->conn->status){
            return null;
        }
        
        $this->attributes = array();
        $this->table_descr = array();
        $this->err_descr="";
    }   

}

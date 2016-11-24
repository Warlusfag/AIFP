<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';
require_once "user_model.php";
require_once "associazione_model.php";

const limit_sez = 5;


class aifp_controller
{
    static public $collection_user;
    static public $collection_sez;
    
    public $descritpion;
    
    function __constructor(){
        
        $this->descritpion = "";
    }  
    
    public function login($password, $email=-1, $user=-1){        
        
        if(!self::$collection_user){
            self::$collection_user = array();
        }
        
        if($email==-1 && $user==-1){
            return false;
        }
        if($email!=-1){
            $params = array(
                'email'=>$email,
                'password'=>md5($password),
            );            
        }else if ($user != -1){
            $params = array(
                'user'=>$user,
                'password'=>md5($password),
            );            
        }
        $us = search_OnAll_users($params);
        if(!$us){
            $this->description = 'ERROR: user or password are not correct';
            return false;
        }        
        $token = md5($email.$password);
        self::$collection_user[$token] = $us;
        $this->descritpion ='';
        return $token;
    }
    
    public function eventi(){
        require_once "evento_class.php";
        return new evento();
    }   
    
    public function funghi(){
        require_once "funghi_model.php";
        $funghi = new funghi();
        if(!$funghi){
            //raccolta informazioni         
            return null;
        }
    }
    
    public function piante(){
        return new piante();
    }
    
    public function forum(){
        require_once "sezione_model.php";  
        
        if(!self::$collection_sez){
            self::$collection_sez = array();
        }        
        $sez = new sezione();        
        $t = $sez->search_sezioni(array(), -1, limit_sez);
        if(!$t){
            $this->descritpion = $sez->err_descr;
        }else{       
            for($i=0;$i<count($t);$i++){
                $sez = new sezione();
                $sez->init($t[$i]);
                self::$collection_sez[$t[$i][$sez->table_descr['key']]];
            }
            $this->descritpion = '';            
        }       
    }
}
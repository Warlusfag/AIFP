<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';
require_once "user_model.php";
require_once "associazione_model.php";
require_once "evento_model.php";

//limit constant
const limit_sez = 5;
const limit_events = 20;
const limit_session = 1000000;


class aifp_controller
{
    static public $collection_user;
    static public $collection_sez;
    static public $collection_news;
    
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
        $us = $this->search_OnAll_users($params, 1);
        if(!$us){
            $this->description = 'ERROR: user or password are not correct';
            return false;
        }        
        $token = md5($email.$password);
        self::$collection_user[$token] = $us;
        $this->descritpion ='';
        return $token;
    }

    function get_type_from_pkey($primary_key){
        $us = new user();
        if($us->table_descr['key'] == $primary_key){
            return $us->table_descr['type'];
        }
        $us = new iscritto();
         if($us->table_descr['key'] == $primary_key){
            return $us->table_descr['type'];
        }
        $us = new micologo();
         if($us->table_descr['key'] == $primary_key){
            return $us->table_descr['type'];
        }
        $us = new botanico();
         if($us->table_descr['key'] == $primary_key){
            return $us->table_descr['type'];
        }
        $us = new associazione();
         if($us->table_descr['key'] == $primary_key){
            return $us->table_descr['type'];
        }
        return false;
    }

    function get_us_from_type($type){
        if($type == 'utente'){
            $us = new user();
        }
        else if($type == 'inscritto'){
            $us = new inscritto();
        }
        else if($type == 'micolgo'){
            $us = new inscritto();
        }
        else if($type == 'botanico'){
            $us = new inscritto();
        }
        else if($type == 'associazione'){
            $us = new associazione();
        }
        else{return null;}

        return $us;    
    }

    function search_OnAll_users($params, $limit=-1, $type=-1){
        $count = 0;
        $ris = array();
        if($type != -1){
            $n = 1;
        }else{
            $n = count(types);
        }
        for($i=0;$i<$n;$i++){
            if($type != -1){
                $us = get_us_from_type($type);
                if($us == null){
                    return null;
                }
                $i = array_keys($ris, $type);
            }else{
                $us = get_us_from_type(types[$i]);
            }        
            $t = $us->search_user($params);
            if($limit == -1 && $t){
                array_merge($ris, $t);
            }else if ($limit == 1 && count($t)==1){
                $id = array( $us->table_descr['key'] => $t[0][$us->table_descr['key']]);
                $temp_descr = $us->search_descr_user($id,-1, types[$i]);
                if(!$temp_descr){
                    return null;
                }
                $us->init($t, $temp_descr);
                return $us;
            }else if($limit > 1 && $t){            
               if($count($t) + $count <= $limit){
                    $count += count($t);           
                    array_merge($ris, $t);
               }else{
                    $diff = $limit - $count;
                    for($j=0;$j<$diff;$j++){
                       array_merge($ris,$t[$j]);
                    }
                    return $ris;
               }     
            }
        }
        return $ris;
    }

    function search_OnAll_descr_users($params, $limit=-1, $type=-1){
        $count = 0;
        $ris = array();
        if($type != -1){
            $n = 1;
        }else{
            $n = count(types);
        }
        for($i=0;$i<$n;$i++){
            if($type != -1){
                $us = get_us_from_type($type);
                if($us == null){
                    return null;
                }
                $i = array_keys($ris, $type);
            }else{
                $us = get_us_from_type(types[$i]);
            }        
            $t = $us->search_descr_user($params);
            if($limit == -1 && $t){
                array_merge($ris, $t);
            }else if ($limit == 1 && count($t)==1){
                $id = array( $us->table_descr['key'] => $t[0][$us->table_descr['key']]);
                $temp_descr = $us->search_user($id,-1, type[$i]);
                if(!$temp_descr){
                    return null;
                }
                $us->init($t, $temp_descr);
                return $us;
            }else if($limit > 1 && $t){            
               if($count($t) + $count <= $limit){
                    $count += count($t);           
                    array_merge($ris, $t);
               }else{
                    $diff = $limit - $count;
                    for($j=0;$j<$diff;$j++){
                       array_merge($ris,$t[$j]);
                    }
                    return $ris;
               }     
            }
        }
        return $ris;
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
                self::$collection_sez[$i] = $sez;
            }
            $this->descritpion = '';
            return $t;
        }       
    }
    
    public function get_news(){
        if(evento::$inserted || count(self::$collection_news)==0){
            $ev = new evento();
            self::$collection_news = $ev->show_news(20);
        }
    }
}
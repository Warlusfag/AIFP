<?php

require_once 'admin/setup.php';
require_once 'admin/utils.php';
require_once "user_model.php";
require_once "associazione_model.php";
require_once "evento_model.php";
require_once "admin_model.php";


//limit constant
const limit_sez = 5;
const limit_events = 20;
const limit_session = 1000000;



class aifp_controller
{
    static public $collection_user;
    static public $collection_sez;
    static public $collection_news;
    static public $collection_funghi;
    public $tipo;
    
    public $descritpion;
    
    function __constructor(){
        
        $this->descritpion = "";
        $this->tipo = array(
            0 =>'utente',
            1 =>'inscritto',
            2=>'micologo',
            3=>'botanico',
            4=>'associazione',
            5=>'admin',
        );
    }  
    
    public function login($password, $email=-1, $user=-1, $type = -1){
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
        if(!$us || count($us)){
                $this->description = "ERROR: mail|username or password are not correct";
                return false;
        }
        $k = array_keys($us);
        $user = $this->get_user_from_pkey($k[0]);
        $params = array(
                $k[0] => $us[$k[0]],
        );
        $us_descr= $user->search_descr_user($params, 1);		
        $user->init($us, $us_descr);

        $token = md5($email.$password); 
        self::$collection_user[$token] = $user; 
        $this->descritpion =''; 
        return $token; 
        
    } 

    function get_user_from_pkey($primary_key){
        $us = new user();
        if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new iscritto();
        if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new micologo();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new botanico();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        $us = new associazione();
         if($us->table_descr['key'] == $primary_key){
            return $us;
        }
        return null;
    }

    function get_us_from_type($type){
        $us = new user();
        if($us->type == $type){
            return $us;
        }
        $us = new inscritto();
        if($us->type == $type){
            return $us;
        }
        $us = new micologo();
        if($us->type == $type){
            return $us;
        }
        $us = new inscritto();
        if($us->type == $type){
           return $us; 
        }
        $us = new associazione();
        if($us->type == $type){
            return $us;
        }
        $us = new admin();
        if($us->type == $type){
            return $us;
        }
        return null;   
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
                 $us = $this->get_us_from_type($type); 
                if($us == null){ 
                         return null; 
                } 
                $i = array_search($ris, $type); 
        }else{ 
                 $us = $this->get_us_from_type($this->tipo[$i]); 
        }         
        $t = $us->search_user($params); 
        if($limit == -1 && $t){ 
            array_merge($ris, $t); 
        }else if($limit == 1 && $t){
            if(count($t)==1){
                    return $t;
            }else{
                    return false;
            }
        }else if($t){             
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
            $us = $this->get_us_from_type($type); 
            if($us == null){ 
                return null; 
            } 
           $i = array_search($ris, $type); 
        }else{ 
            $us = $this->get_us_from_type($this->tipo[$i]); 
        }         
        $t = $us->search_descr_user($params); 
        if($limit == -1 && $t){ 
            array_merge($ris, $t); 
        }else if($limit == 1 && $t){
            if(count($t)==1){
                    return $t;
            }else{
                    return false;
            }
        }else if($t){             
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
    
    public function get_schede_funghi(){
        if(!self::$collection_funghi){
            self::$collection_funghi = array(
                'ammanita'=>array(),
                'boletus'=>array(),
                'agaricus'=>array(),
                'tricholoma'=>array(),
                'clitocybe'=>array(),
                'cantharrelus'=>array(),
                'russula'=>array(),
                'lactarius'=>array(),           
            );       
            $model_fungo = new funghi();
            $genere = array_keys(self::$collection_funghi);
            for($i=0;$i<count($genere);$i++){            
                $params = array(
                    'genere'=>$genere[$i],
                );
                self::$collection_funghi[$genere[$i]] = $model_fungo->search_funghi($params, -1, 10);
                if(!self::$collection_funghi[$genere[$i]]){
                    $this->descritpion = $model_fungo->err_descr;
                    return false;
                }
            }
            return true;
        }
        return true;
    }
}
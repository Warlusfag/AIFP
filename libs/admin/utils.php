<?php

function load_file($base_path)
{
    $photo = array();
    if(!is_dir($base_path)){
        return $photo;
    }
    $files = scandir($base_path);
    foreach($files as $file){
        if($file == '.' || $file == '..'){
            continue;
        }        
        $f = $base_path.$file;
        $photo[] =  $f;
    }
}

function find_values($input, $array){
    
    foreach($array as $key => $value){
        if($value == $input){
            return $key;
        }
    }
    return -1;
}

function download ($file)
{   

    if (file_exists($file, $size)) 
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $size);
        if (readfile($file) == false)
        {
            return false;
        }
        else
            return true;
    }
}

function extract_node($array, $node){
    if(is_string($array)){
        $temp = explode(',',$array);
        $n_col = '';
        for($i=0;$i<count($temp);$i++){
            if($i!=$node){
                $n_col .=$temp[$i].',';
            }        
        }
        return str_replace($n_col,'', count($n_col)-2);  
    }else if(is_array($array)){
        if (count($array)<=$node){
            return null;
        }else{
            $temp = array();
            $i=0;
            foreach ($array as $key=>$value){
                if($i == $node){
                    continue;
                }
                $temp[$key]=$value;
            }            
            return $temp;
        }
    }
}
<?php
if(!defined(utils)){
    define('utils',1);
}
function sanitaze_input($input)
{
    $output='';        
    if (get_magic_quotes_gpc())
    {
        $output =  stripcslashes ($input);
    }
    else
    {
        $output = $input;
    }
    return htmlentities(mysql_real_escape_string($output));
}

function check_array($post)
{
    $flag=true;
    foreach ($post as $value )
    {
        if( !(isset($value)) )
        {
            $flag=false;
        }
    }
    return $flag;
    
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
            for($i=0;$i<count($temp);$i++){
                if($i!=$node){
                    $temp[$i] = $array[$i];
                }        
            }
            return $temp;
        }
    }
}
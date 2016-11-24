<?php

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


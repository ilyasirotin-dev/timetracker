<?php

if (!function_exists('print_arr')) {
    function print_arr($var, $return = false)
    {
        $type = gettype($var);
        $out = print_r($var, true);
        $out = htmlspecialchars($out);
        $out = str_replace(' ', '&nbsp;', $out);
        if ($type == 'boolean')
            $content = $var ? 'true' : 'false';
        else
            $content = nl2br($out);
        $out = '<div style="
       border:2px inset #666;
       background:black;
       font-family:monospace;
       font-size:12px;
       color:#6F6;
       text-align:left;
       margin:20px;
       padding:16px">
         <span style="color: #F66">(' . $type . ')</span> ' . $content . '</div><br /><br />';
        if (!$return)
            echo $out;
        else
            return $out;
    }
}
function print_die($var, $return = false)
{
    print_arr($var, $return);
    $info = debug_backtrace();
    print_arr("File: {$info[0]['file']} Line: {$info[0]['line']}");
    die ();
}
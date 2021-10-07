<?php

if (!function_exists('view')) 
{
    function view($page, $data) 
    {
        
        // ob_start();
        extract($data);
        require BASE_DIR.'/src/View/'.$page.'.php';
        // $str = ob_get_contents();
        // ob_end_clean();
        // return $str;
    }
}

if (!function_exists('dd'))
{
    function dd($data) 
    {
        echo '<pre>';
        print_r($data);
        die();
    }
}
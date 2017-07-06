<?php

function dumpvar($arr, $exit = false){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if($exit)
        exit;
}

function redirect($url){
    header('Location:' . BASEPATH . $url);
}

function message($txt, $index = 'message'){
    $_SESSION[$index] = $txt;
}

function getSEOTitle($title)
{
    $specialCharacters = array(
        '&reg;' => '',
        '#' => '',
        '$' => '',
        '%' => '',
        '&' => '',
        '@' => '',
        '.' => '',
        ',' => '',
        '?' => '',
        '+' => '',
        '=' => '',
        '?' => '',
        '<' => '',
        '>' => '',
        '!' => '',
        '/' => '',
        "'" => '',
        '"' => ''
    );

    $title = strtr($title, $specialCharacters);
    return  preg_replace("/[^[:alnum:][:punct:]]/","-", $title);
}
function getProductCode($id){
   return 'PRO-' . str_pad($id, 5, '0', STR_PAD_LEFT);
}

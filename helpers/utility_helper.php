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
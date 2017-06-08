<?php
/**
 * main page model example
 *
 * */
class Product_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getProducts(){
        echo 'cameherere';
    }
}
<?php
/**
 * main page model example
 *
 * */
class Category_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getProducts(){
        $sth = $this -> db -> fetchAllAssoc('SELECT id,text FROM data');
        return $sth;
    }
}
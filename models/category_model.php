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

    function getCategoryList(){
        $sql = "SELECT c.category_id, c.category_title, p.category_title AS parent_category_title 
                       FROM tbl_category c LEFT JOIN tbl_category p 
                       ON c.parent_category_id = p.category_id";
        $result = $this -> db -> fetchAllAssoc($sql);
        return $result;
    }
}
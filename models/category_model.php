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
        $sql = "SELECT c.category_id, c.parent_category_id, c.category_title, p.category_title AS parent_category_title 
                       FROM tbl_category c LEFT JOIN tbl_category p 
                       ON c.parent_category_id = p.category_id";
        $result = $this -> db -> fetchAllAssoc($sql);
        return $result;
    }

    function saveCategory(){
        $data['category_id'] = isset($_POST['category_id']) ? filter_var($_POST['category_id'],FILTER_SANITIZE_STRING) : 0;
        $data['category_title'] = filter_var($_POST['category_title'],FILTER_SANITIZE_STRING);
        $data['parent_category_id'] = filter_var($_POST['parent_category_id'],FILTER_SANITIZE_STRING);
        if(!$data['category_id']){
            $sql = "INSERT INTO tbl_category(category_id, parent_category_id, category_title) values(:category_id, :parent_category_id, :category_title)";
        }
        else{
            $sql = "UPDATE tbl_category SET parent_category_id = ?, category_title = ? WHERE category_id = ?";
        }
        $this -> db -> onlyExecute($sql, array($data['parent_category_id'], $data['category_title'], $data['category_id']));
    }

    function getCategoryById($category_id){

        $sql = "SELECT *FROM tbl_category WHERE :category_id = category_id";
        return $this->db->fetchSingle($sql, array(':category_id' => $category_id));
    }
}
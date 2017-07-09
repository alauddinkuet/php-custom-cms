<?php
/**
 * main page model example
 *
 * */
class Review_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function addReview(){
        $data['product_id'] = isset($_POST['product_id']) ? filter_var($_POST['product_id'],FILTER_SANITIZE_STRING) : 0;
        $data['name']       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $data['email']      = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $data['comment']    = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
        $data['rating']     = filter_var($_POST['rating'],FILTER_SANITIZE_STRING);
        $data['created_on'] = date('Y-m-d H:i:s');
        $sql = "INSERT INTO tbl_review(product_id, name, email, comment, rating, created_on) 
                                values(:product_id,:name,:email,:comment,:rating,:created_on)";
        $data['review_id'] = $this->db->insertRow($sql, $data);

        return $data['review_id'];
    }

    function getReviewByProductId($product_id){
        $sql = "SELECT *FROM tbl_review WHERE product_id = :product_id ORDER BY created_on DESC";
        return $this->db->fetchAllAssoc($sql, array(':product_id' => $product_id));
    }
}
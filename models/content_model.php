<?php
/**
 * main page model example
 *
 * */
class Content_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getContent($page_name_seo){
        $sql = "SELECT *FROM tbl_content_page WHERE page_name_seo = :page_name_seo";
        return $this->db->fetchSingle($sql, array(':page_name_seo' => $page_name_seo));
    }

    function getContentList(){
        $sql = "SELECT page_id, page_name, meta_keywords, meta_description, DATE_FORMAT(created_on, '%Y-%c-%d') as created_on FROM tbl_content_page";
        $result = $this -> db -> fetchAllAssoc($sql);
        return $result;

    }
    function getContentById($page_id){
        $sql = "SELECT *FROM tbl_content_page WHERE page_id = :page_id";
        return $this->db->fetchSingle($sql, array(':page_id' => $page_id));
    }

    function saveContent(){
        $data['page_id']       = isset($_POST['page_id']) ? filter_var($_POST['page_id'],FILTER_SANITIZE_STRING) : 0;
        $data['page_name']     = filter_var($_POST['page_name'],FILTER_SANITIZE_STRING);
        $data['page_name_seo'] = getSEOTitle($data['page_name'], $data['page_id']);
        if($this->checkDuplicateName($data['product_name_seo'], $data['product_id'])){
            $data['product_name_seo'] = $data['product_name_seo'] . '_' . date('Y-m-d');
        }
        $data['category_id']      = filter_var($_POST['category_id'],FILTER_SANITIZE_STRING);
        $data['product_price']    = filter_var($_POST['product_price'],FILTER_SANITIZE_STRING);
        $data['product_description'] = filter_var($_POST['product_description'],FILTER_SANITIZE_STRING);
        $data['product_details']  = filter_var($_POST['product_details']);
        $data['meta_keywords']    = filter_var($_POST['meta_keywords'], FILTER_SANITIZE_STRING);
        $data['meta_description'] = filter_var($_POST['meta_description'], FILTER_SANITIZE_STRING);
        if(!$data['product_id']){
            unset($data['product_id']);
            $data['created_on'] = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_product(product_name, product_name_seo, category_id, product_price, product_description, product_details, meta_keywords, meta_description, created_on) 
                                    values(:product_name,:product_name_seo,:category_id,:product_price,:product_description,:product_details,:meta_keywords,:meta_description,:created_on)";
            $data['product_id'] = $this->db->insertRow($sql, $data);
            $product_code = getProductCode($data['product_id']);
            $sql = "UPDATE tbl_product SET product_code = ? WHERE product_id = ?";
            $this->db->onlyExecute($sql, array($product_code, $data['product_id']));
        }
        else{
            $sql = "UPDATE tbl_product SET product_name = ?, product_name_seo = ?, category_id = ?, product_price = ?, product_description = ?, product_details = ?, meta_keywords = ?, meta_description = ? WHERE product_id = ?";
            $this -> db -> onlyExecute($sql, array($data['product_name'], $data['product_name_seo'], $data['category_id'], $data['product_price'], $data['product_description'], $data['product_details'], $data['meta_keywords'], $data['meta_description'], $data['product_id']));
        }
        return $data['product_id'];
    }


}
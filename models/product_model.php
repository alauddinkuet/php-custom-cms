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
        $sql = "SELECT product_id,
                       product_code,                       
                       product_name,
                       category_title, 
                       product_price,
                       DATE_FORMAT(created_on, '%Y-%c-%d') as created_on
                       FROM tbl_product AS p LEFT JOIN 
                       tbl_category AS c ON(p.category_id = c.category_id) ORDER BY category_title";
        $sth = $this -> db -> fetchAllAssoc($sql);
        return $sth;
    }

    function saveProduct(){
        $data['product_id']       = isset($_POST['product_id']) ? filter_var($_POST['product_id'],FILTER_SANITIZE_STRING) : 0;
        $data['product_name']     = filter_var($_POST['product_name'],FILTER_SANITIZE_STRING);
        $data['product_name_seo'] = getSEOTitle($data['product_name']);
        $data['category_id']      = filter_var($_POST['category_id'],FILTER_SANITIZE_STRING);
        $data['product_price']    = filter_var($_POST['product_price'],FILTER_SANITIZE_STRING);
        $data['product_description'] = filter_var($_POST['product_description'],FILTER_SANITIZE_STRING);

        if(!$data['product_id']){
            unset($data['product_id']);
            $data['created_on'] = date('Y-m-d H:i:s');
            $sql = "INSERT INTO tbl_product(product_name, product_name_seo, category_id, product_price, product_description, created_on) 
                                    values(:product_name,:product_name_seo,:category_id,:product_price,:product_description,:created_on)";
            $data['product_id'] = $this->db->insertRow($sql, $data);
            $product_code = getProductCode($data['product_id']);
            $sql = "UPDATE tbl_product SET product_code = ? WHERE product_id = ?";
            $this->db->onlyExecute($sql, array($product_code, $data['product_id']));
        }
        else{
            $sql = "UPDATE tbl_product SET product_name = ?, category_id = ?, product_price = ?, product_description = ? WHERE product_id = ?";
            $this -> db -> onlyExecute($sql, array($data['product_name'], $data['category_id'], $data['product_price'], $data['product_description'], $data['product_id']));
        }
        return $data['product_id'];
    }

    function getProductById($id){
        $sql = "SELECT *FROM tbl_product WHERE product_id = :product_id";
        return $this->db->fetchSingle($sql, array(':product_id' => $id));
    }

    function getProductImages($id){
        $sql = "SELECT *FROM tbl_product_image WHERE product_id = :product_id";
        return $this->db->fetchAllAssoc($sql, array(':product_id' => $id));
    }

    function deleteProductById($id){

        $sql = "DELETE FROM tbl_product WHERE product_id = :product_id";
        return $this->db->fetchSingle($sql, array(':product_id' => $id));
    }
    function deleteImage($id){
        $image = $this->getImageById($id);
        @unlink(DOCUMENT_ROOT. 'product_image/'. $image['file_name']);
        $sql = "DELETE FROM tbl_product_image WHERE id = :id";
        return $this->db->onlyExecute($sql, array(':id' => $id));
    }

    function getImageById($id){
        $sql = "SELECT *FROM tbl_product_image WHERE id = :id";
        return $this->db->fetchSingle($sql, array(':id' => $id));
    }

    function saveImage($data){
        $sql = "INSERT INTO tbl_product_image(product_id, file_name, file_org_name, created_on) 
                                    values(:product_id,:file_name,:file_org_name,:created_on)";
        return $this->db->insertRow($sql, $data);
    }
}
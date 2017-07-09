<?php
/**
 * Main page controller example
 * 
 * TODO form and request helper consider to use symfony2 request component
 */
class Product extends Controller {

	function __construct() {
        parent::__construct('product_model');

        $this->session = new Session();
        //$this->session->start();

		if (!$this->session->get('loggedIn') || !($this->session->get('username'))) {
			header('location:' . BASEPATH . 'login');
		} 
	}

	function index() {
        $this->loadModel('category_model', 'category');
        $this -> viewLoader -> tableData = $this->model->getProducts();
        $this -> viewLoader -> category = $this->category->getCategoryList();

		$this -> viewLoader -> render('product/list');
	}

    function form($product_id =null) {
        $this->loadModel('category_model', 'category');
        if($product_id){
            $this -> viewLoader -> product = $this->model->getProductById($product_id);
        }
        $this -> viewLoader -> category = $this->category->getCategoryList();

        $this -> viewLoader -> render('product/form');
    }

    function image($product_id){
	    if(is_numeric($product_id))
            $this->session->set('product_id', $product_id);

        $this->viewLoader->images  = $this->model->getProductImages($this->session->get('product_id'));
        $this->viewLoader->image_list =  $this -> viewLoader -> render('product/image_list', array(),true);

        $this->viewLoader->product = $this->model->getProductById($product_id);
        $this -> viewLoader -> render('product/image_form');
    }
    function getImageList(){
        $this->viewLoader->images  = $this->model->getProductImages($this->session->get('product_id'));
        return $this -> viewLoader -> render('product/image_list', array(),true);
    }
    function upload_image(){
        header('Content-Type: application/json');
        $output_dir = PRODUCT_IMAGE_PATH;
        if(isset($_FILES["myfile"]))
        {
            $ret = array();
            $error =$_FILES["myfile"]["error"];
            if(!is_array($_FILES["myfile"]["name"])) //single file
            {
                $file_name = $_FILES["myfile"]["name"];
                if(file_exists($output_dir.$file_name)){
                    $file = explode('.', $file_name);
                    $file_name = time() . '.' . $file[count($file) - 1];
                }
                move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$file_name);
                $ret['file_name']= $file_name;
            }
            else  //Multiple files, file[]
            {
                $fileCount = count($_FILES["myfile"]["name"]);
                for($i=0; $i < $fileCount; $i++)
                {
                    $file_name = $_FILES["myfile"]["name"][$i];
                    if(file_exists($output_dir.$file_name)){
                        $file = explode('.', $file_name);
                        $file_name = time() . $file[count($file) - 1];
                    }
                    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$file_name);
                    $ret['file_name'] = $file_name;
                }
            }
            $data['file_name'] = $file_name;
            $data['file_org_name'] = $_FILES["myfile"]["name"];
            $data['product_id'] = $this->session->get('product_id');
            $data['created_on'] = date('Y-m-d H:i:s');
            $this->model->saveImage($data);
            $ret['image_list'] = $this->getImageList();
            echo json_encode($ret);
        }
    }
	function save() {
        $this->model->saveProduct();
        message('Product Saved Successfully.');
        redirect('admin/product');
	}

    function delete($product_id){
        $this->model->deleteProductById($product_id);
        message('Product Deleted Successfully.');
        redirect('admin/product');
    }
    function deleteImage($id){

        $this->model->deleteImage($id);
        message('Image Deleted Successfully.');
        redirect('admin/product/image/' . $this->session->get('product_id'));
    }
    
    function imagePrimary($id, $is_primary){
       $this->model->updateImage($this->session, $id, $is_primary); 
    }
}
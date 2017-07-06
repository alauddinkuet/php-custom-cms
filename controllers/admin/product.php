<?php
/**
 * Main page controller example
 * 
 * TODO form and request helper consider to use symfony2 request component
 */
class Product extends Controller {

	function __construct() {
        parent::__construct('product_model');

        $this->session=new Session();
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
}
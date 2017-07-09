<?php
/**
 * Main page controller example
 * 
 * TODO form and request helper consider to use symfony2 request component
 */
class Index extends Controller {

	function __construct() {

		
			parent::__construct();
			 	
			$this->session=new Session();
			$this->session->start();
			
	}

	function index() {
        
	    $this->loadModel('product_model', 'product');
        $this->loadModel('category_model', 'category');
	    $products = $this->product->getProducts();
	    foreach($products as $key => $item){
	        if($item['featured']){
                $this->viewLoader->featured_images = $this->product->getProductImages($item['product_id']);
            }
	        $image = $this->product->getProductImages($item['product_id'], 1);
	        if(isset($image[0]['file_name']))
	            $products[$key]['file_name'] = PRODUCT_IMAGE_URL . $image[0]['file_name'];
        }

        $this->viewLoader->categories = $this->category_list();
        $this->viewLoader->products = $products;
		$this -> viewLoader -> renderFront('home');
	}
}

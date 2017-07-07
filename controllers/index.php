<?php
/**
 * Main page controller example
 * 
 * TODO form and request helper consider to use symfony2 request component
 */
class Index extends Controller {

	function __construct() {

		
			parent::__construct('main_model');
			 	
			$this->session=new Session();
			$this->session->start();
			
	}

	function index() {
        
	    $this->loadModel('product_model', 'product');
	    $this->viewLoader->products = $this->product->getProducts();
        //dumpvar($this->viewLoader->products);
		//$this -> viewLoader -> tableData = $this -> model -> getData();
		$this -> viewLoader -> renderFront('main');
	}
}

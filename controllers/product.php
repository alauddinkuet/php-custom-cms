<?php
/**
 * Main page controller example
 *
 * TODO form and request helper consider to use symfony2 request component
 */
class Product extends Controller {

    function __construct() {


        parent::__construct();

        $this->session=new Session();
        $this->session->start();

    }

    function items($category_id = null) {

        $this->loadModel('product_model', 'product');
        $this->loadModel('category_model', 'category');
        $products = $this->product->getProducts($category_id);
        foreach($products as $key => $item){
            $image = $this->product->getProductImages($item['product_id'], 1);
            if(isset($image[0]['file_name']))
                $products[$key]['file_name'] = PRODUCT_IMAGE_URL . $image[0]['file_name'];
        }
        $this->viewLoader->products = $products;
        $this->viewLoader->categories = $this->category_list();
        $this -> viewLoader -> renderFront('home');
    }

    function details($seo_name){
        $this->loadModel('product_model', 'product');
        $this->loadModel('review_model', 'review');
        $product = $this->product->getProductBySeoName($seo_name);
        $this->viewLoader->reviews = $this->review->getReviewByProductId($product['product_id']);
        $this->viewLoader->categories = $this->category_list();
        $this->viewLoader->product = $product;
        $this->viewLoader->meta_keywords = $product['meta_keywords'];
        $this->viewLoader->meta_description = $product['meta_description'];


        $this->viewLoader->images = $this->product->getProductImages($product['product_id']);
        $this-> viewLoader->renderFront('product_details');
    }

    function review(){
        $this->loadModel('review_model', 'review');
        $this->review->addReview();
        message('Review Added Successfully');
        header('Location:'. $_SERVER[HTTP_REFERER]);
    }
}

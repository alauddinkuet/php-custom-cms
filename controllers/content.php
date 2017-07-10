<?php
/**
 * Main page controller example
 *
 * TODO form and request helper consider to use symfony2 request component
 */
class Content extends Controller {

    function __construct() {
        parent::__construct('content_model');
        $this->session=new Session();
        $this->session->start();
    }

    function about(){
        $content = $this->model->getContent('about');
        $this->viewLoader->content = $content;
        $this->viewLoader->meta_keywords = $content['meta_keywords'];
        $this->viewLoader->meta_description = $content['meta_description'];

        $this->viewLoader->categories = $this->category_list();
        $this -> viewLoader -> renderFront('content_page');
    }

    function services(){
        $content = $this->model->getContent('services');
        $this->viewLoader->content = $content;
        $this->viewLoader->meta_keywords = $content['meta_keywords'];
        $this->viewLoader->meta_description = $content['meta_description'];
        $this->viewLoader->categories = $this->category_list();
        $this -> viewLoader -> renderFront('content_page');
    }

    function contact(){
        $content = $this->model->getContent('contact-us');
        $this->viewLoader->content = $content;
        $this->viewLoader->meta_keywords = $content['meta_keywords'];
        $this->viewLoader->meta_description = $content['meta_description'];
        $this->viewLoader->categories = $this->category_list();
        $this -> viewLoader -> renderFront('content_page');
    }
}

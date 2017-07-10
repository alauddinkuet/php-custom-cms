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
    }

    function index(){
        $this -> viewLoader -> tableData = $this->model->getContentList();
        $this -> viewLoader -> render('content/content_list');
    }
    function form($page_id =null) {
        if($page_id){
            $this->viewLoader->page = $this->model->getContentById($page_id);
        }
        $this -> viewLoader -> render('content/form');
    }
    function save() {
        $this->model->saveContent();
        message('Page Saved Successfully.');
        redirect('admin/content');
    }


}

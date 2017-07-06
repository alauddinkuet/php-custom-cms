<?php
class Category extends Controller
{
    function __construct(){
        parent::__construct('category_model');
        $this->session = new Session();
        //$this->session->start();

        if (!$this->session->get('loggedIn') || !($this->session->get('username'))) {
            redirect('login');
        }
    }

    function index($category_id = null){
        $this -> viewLoader -> tableData = $this->model->getCategoryList();
        if($category_id)
            $this -> viewLoader -> category = $this->model->getCategoryById($category_id);

        $this -> viewLoader -> render('category');
    }
    function save(){
        $this->model->saveCategory();
        message('Category Saved Successfully.');
        redirect('admin/category');
    }

    function delete($categoryId){
        $this->model->deleteCategoryById($categoryId);
        message('Category Deleted Successfully.');
        redirect('admin/category');
    }
}
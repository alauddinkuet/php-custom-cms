<?php
class Category extends Controller
{

    function __construct()
    {
        parent::__construct('category_model');

        $this->session = new Session();
        //$this->session->start();

        if (!$this->session->get('loggedIn') || !($this->session->get('username'))) {
            header('location:' . BASEPATH . 'login');
        }
    }

    function index($category_id = null)
    {
        $this -> viewLoader -> tableData = $this->model->getCategoryList();
        if($category_id)
            $this -> viewLoader -> category = $this->model->getCategoryById($category_id);

        $this -> viewLoader -> render('category');
    }
    function saveCategory()
    {
        $this->model->saveCategory();
        redirect('admin/category');
    }
}
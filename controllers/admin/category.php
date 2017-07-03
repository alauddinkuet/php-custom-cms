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

    function index()
    {
        $this -> viewLoader -> tableData = $this->model->getCategoryList();
        $this -> viewLoader -> render('category');
    }
    function saveCategory()
    {

    }
}
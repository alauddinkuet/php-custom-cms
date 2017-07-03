<?php
class Category extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->session = new Session();
        //$this->session->start();

        if (!$this->session->get('loggedIn') || !($this->session->get('username'))) {
            header('location:' . BASEPATH . 'login');
        }
    }

    function index()
    {

    }
}
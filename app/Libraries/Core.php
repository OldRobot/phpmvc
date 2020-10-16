<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 * URL Format  - /controller/method/params
 */
class Core { 
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];


    public function __construct(){
        //print_r($this->getUrl());

        $url  = $this->getUrl();

        //look in controllers for first value, from index.php
        if(file_exists('../app/controllers/' . ucwords($url[0]) . 'php')){
            //set  as current conntroller
            $this->currentController  = ucwords($url[0]);
            //unset the 0 index
            unset($url[0]);
        }
        //require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate the controller class.
        // eg $pages = new pages
        $this->currentController = new $this->currentController;

    
        //got to 9:50 just going to create pages.php
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } 
    }
 
}


 
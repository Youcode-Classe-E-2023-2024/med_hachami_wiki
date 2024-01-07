<?php

Class Admin extends Controller{

    

    public function __construct(){
       
    }
    public function index(){
        return $this->view('admin/index');
    }

    
   
    

}
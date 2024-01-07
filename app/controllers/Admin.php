<?php

Class Admin extends Controller{

    

    public function __construct(){
       if(!adminIsLoggedIn()){
            $this->view('auth');
       }
    }
    public function index(){
        
          return $this->view('admin/index');
    }

    
   
    
   
    

}
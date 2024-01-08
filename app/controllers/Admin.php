<?php

Class Admin extends Controller{

    private $categoryModel;

    public function __construct(){
    //    if(!adminIsLoggedIn()){
    //         $this->view('auth');
    //    }
       $this->categoryModel = $this->model('Category');
    }
    public function index(){
        
          return $this->view('admin/index');
    }

    public function categories(){
        $categories = $this->categoryModel->allCategories();
        $data=[
            'categories'=>$categories
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            
            $postData=[
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $addCategory = $this->categoryModel->addNewCategory($postData);
            if($addCategory){
                
                echo json_encode(["message"=>"category added successfully"]);
            }else{
                echo json_encode(["error"=>"error creating category"]);
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $editedCategory = $this->categoryModel->editCategory($postData);
            if($editedCategory){
                
                echo json_encode(["message"=>"category edited successfully"]);
            }else{
                echo json_encode(["error"=>"error editing category"]);
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                
            ];
            $deletedCategory = $this->categoryModel->deleteCategory($postData);
            if($deletedCategory){
                
                echo json_encode(["message"=>"category deleted successfully"]);
            }else{
                echo json_encode(["error"=>"error deleting category"]);
            }
        }
        else{
            return $this->view("admin/categories" , $data);
        }
        
    }

    public function category($id){
        $category = $this->categoryModel->getCategoryById($id);
        echo json_encode($category);

    }

    
   
    
   
    

}
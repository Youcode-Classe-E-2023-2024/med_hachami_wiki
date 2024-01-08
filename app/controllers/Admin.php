<?php

Class Admin extends Controller{

    private $categoryModel;
    private $tagsModel;

    public function __construct(){
       if(!adminIsLoggedIn()){
            $this->view('auth');
       }
       $this->categoryModel = $this->model('Category');
       $this->tagsModel = $this->model('Tag');
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
    public function tags(){
        $tags = $this->tagsModel->allTags();
        $data=[
            'tags'=>$tags
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            
            $postData=[
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $addedTag = $this->tagsModel->addNewTag($postData);
            if($addedTag){
                
                echo json_encode(["message"=>"tag added successfully"]);
            }else{
                echo json_encode(["error"=>"error creating tag"]);
            }
        }else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                "name"=>trim($postData['name']),
                "description"=>trim($postData['description']),
            ];
            $editedtag = $this->tagsModel->editTag($postData);
            if($editedtag){
                
                echo json_encode(["message"=>"tag edited successfully"]);
            }else{
                echo json_encode(["error"=>"error editing tag"]);
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $json = file_get_contents('php://input');
            $postData = json_decode($json, true);
            $postData=[
                "id"=>trim($postData["id"]),
                
            ];
            $deletedTag = $this->tagsModel->deleteTag($postData);
            if($deletedTag){
                
                echo json_encode(["message"=>"tag deleted successfully"]);
            }else{
                echo json_encode(["error"=>"error deleting tag"]);
            }
        }
        else{
            return $this->view("admin/tags" , $data);
        }
        
    }

    public function category($id){
        $category = $this->categoryModel->getCategoryById($id);
        echo json_encode($category);

    }

    public function tag($id){
        $tag = $this->tagsModel->getTagyById($id);
        echo json_encode($tag);

    }

    
   
    
   
    

}
<?php

Class User{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function register($data){
        $this->db->query("INSERT INTO user (full_name , email , password , imgUrl , roleId) VALUES (:full_name , :email , :password , :imgUrl , :roleId) ");
        $this->db->bind(':full_name' , $data['full_name'] );
        $this->db->bind(':email' , $data['email'] );
        $this->db->bind(':password' , $data['password'] );
        $this->db->bind(':imgUrl' , $data['image'] );
        $this->db->bind(':roleId' , 2 );

        return $this->db->execute();
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);
    
        $row = $this->db->single();
    
        return ($row) ? true : false;
    }

    public function getAllUsers(){
      $this->db->query('SELECT id , full_name , email , imgUrl FROM user');
      return $this->db->resultSet();
    }

    public function login($email, $password){
        $this->db->query('SELECT * FROM user WHERE email = :email ');
        $this->db->bind(':email', $email);
    
        $row = $this->db->single();
        
        if($row){
         
          $hashed_password = $row->password;
          if(password_verify($password, $hashed_password)){
            $this->db->query('SELECT id,email,full_name , imgUrl , roleId FROM user WHERE email = :email ');
            $this->db->bind(':email', $email);
            return $this->db->single();
          } else {
            return false;
          }
        }else{
          return false;
        }
        
      }

      public function getNumOfUsers(){
        $this->db->query("SELECT * FROM user WHERE roleId = :roleId ;");
        $this->db->bind(":roleId",2);
        $this->db->execute();
        return $this->db->rowCount();
      }


}
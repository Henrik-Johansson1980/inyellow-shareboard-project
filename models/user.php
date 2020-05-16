<?php
class UserModel extends Model {
  public function register() {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
        if(isset($post['submit'])) {
          if($post['submit']){
            $password;
            // foreach($post as $key){
            //   if($key == ""){
            //     echo "Fill out the form";
            //     return;
            //   }
            // }
            if (isset($post['password']) AND $post['password'] != "") {
              $password = password_hash($post['password'], PASSWORD_DEFAULT);
            }
            else {
              die('Enter a password');
            }
            //Insert
            $this->query('INSERT INTO users ( name, email, password) VALUES (:name, :email, :password)');
            $this->bind(":name", $post['name']);
            $this->bind(":email", $post['email']);
            $this->bind(":password", $password);
            $this->execute();
            //Verify
            if($this->lastInsertId()) {
              //Redirect
              header('Location:'. ROOT_URL . 'users/login');
            }
          }
          return;
        }
  }

  public function login(){
    //Sanitize Post
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $password = '';        
    $hashedPassword = '';

    if(isset($post['submit'])) {
      if($post['submit']){
        if(isset($post['password'])){
          $password = $post['password'];
        }
        //Get User with matching email
        $this->query('SELECT * FROM users WHERE email = :email');
        $this->bind(":email", $post['email']);
        $this->execute();
        $row = $this->result();
        if($row){
          if(isset($row['password']))
            $hashedPassword = $row['password'];
        
          if(password_verify($password, $hashedPassword)){
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_data'] = [
              'id' => $row['id'],
              'name' => $row['name'],
              'email' => $row['email']
            ];
            header('Location:'. ROOT_URL . 'shares');
          }
          else
            echo 'Incorrect Username or Password ';  
        } else {
          echo 'Incorrect Username or Password ';
        }
      }
      return;
    } 
  }
}
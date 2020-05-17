<?php
class UserModel extends Model {
  public function register() {
        //Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($post['submit'])) {
          if($post['submit']){
            $password = null;
            
            if (isset($post['name']) AND $post['name'] == "") {
              Message::setMessage('Enter a name', 'error');
              return;
            }
            if (isset($post['email']) AND $post['email'] == "") {
              Message::setMessage('Enter an email adress', 'error');
              return;
            } elseif ( $post['email'] != ""){
              if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                Message::setMessage('Enter a valid email adress', 'error');
                return;
              }
            }

            if (isset($post['password']) AND $post['password'] != "") {
              $password = password_hash($post['password'], PASSWORD_DEFAULT);
            } elseif ( $post['password'] == "") {
              Message::setMessage('Enter a password', 'error');
              return;
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
            Message::setMessage('Incorrect Username or Password', 'error');
        } else {
          Message::setMessage('Incorrect Username or Password', 'error');
        }
      }
      return;
    } 
  }
}
<?php
class ShareModel extends Model {
  public function Index() {
    $this->query('SELECT shares.*,  users.name FROM shares LEFT JOIN users ON shares.user_id = users.id ORDER BY create_date DESC');
    $rows = $this->resultSet();
    return $rows;
  }

  public function add () {
    //Sanitize Post
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if(isset($post['submit'])) {
      if($post['submit']){
        if($post['title'] == "" OR $post['body'] == "" OR $post['link'] == "" ){
          Message::setMessage('Please fill in all fields', 'error');
          return;
        }

        //Insert
        $this->query('INSERT INTO shares ( title, body, link, user_id) VALUES (:title, :body, :link, :user_id)');
        $this->bind(":title", $post['title']);
        $this->bind(":body", $post['body']);
        $this->bind(":link", $post['link']);
        $this->bind(":user_id", $post['user_id']);
        $this->execute();
        //Verify
        if($this->lastInsertId()) {
          //Redirect
          header('Location:'. ROOT_URL . 'shares');
        }
      }
      return;
    }
  }
}
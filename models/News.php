<?php
require_once ("../controllers/news.controller.php");
require_once("../config/cookies.php");

class News extends Connect {
    
  public function createNew($userid, $new_title, $new_content, $new_date, $new_time, $new_image){
    $connect=parent::Conection();
    $sql = "INSERT INTO news
      (new_title, new_content, new_date, new_time, new_image, user_id)
      VALUES (?,?,?,?,? ,?)
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $new_title, PDO::PARAM_STR);
    $stmt->bindParam(2, $new_content, PDO::PARAM_STR);
    $stmt->bindParam(3, $new_date, PDO::PARAM_STR);
    $stmt->bindParam(4, $new_time, PDO::PARAM_STR);
    $stmt->bindParam(5, $new_image, PDO::PARAM_STR);
    $stmt->bindParam(6, $userid, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  
  public function editNew($new_id, $new_title, $new_content, $new_image){
    $connect=parent::Conection();
    $sql = "UPDATE news
      SET new_title = ?, new_content = ?, new_image = ?
      WHERE id = ?
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $new_title, PDO::PARAM_STR);
    $stmt->bindParam(2, $new_content, PDO::PARAM_STR);
    $stmt->bindParam(3, $new_image, PDO::PARAM_STR);
    $stmt->bindParam(4, $new_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function deleteNew($new_id){
    $connect=parent::Conection();
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $new_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  

  public function getNewsTable($userid, $sql_query, $view_type, $offset, $limit){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = $sql_query;
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $limit, PDO::PARAM_INT);
    $stmt->bindParam(2, $offset, PDO::PARAM_INT);

    $response = "
      <table>
        <tr>
          <td>Imagen</td>
          <td>Título</td>
          <td>Contenido</td>
          <td>Fecha y hora</td>
          <td>Autor</td>
          <td></td>
          
        </tr>
    ";
    try {
      $stmt->execute();
      if ($stmt->rowCount() <= 0) {
        $response = "
          <div class='content_box light centered'>
            <span class='material-symbols-rounded pretty'>search_off</span>
            <h1 class='info'>No hay noticias</h1>
          </div>
        ";
        return $response;
      }
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $new_id = $row["id"];
        $new_title = $row["new_title"];
        $new_content = $row["new_content"];
        $new_image = $row["new_image"];
        $new_date = $row["new_date"];
        $new_time = $row["new_time"];
        $new_date_formated = date("d", strtotime($row["new_date"])) . ' ' . $months[date("m", strtotime($row["new_date"]))]. ' ' . date("y", strtotime($row["new_date"]));
        $new_time_formated = date("h:i a", strtotime($row["new_time"]));

        $new_author = $row["user_id"];
        $user_name = $row["user_name"];

        $response .= "
          <tr
            data-new-id='$new_id' 
            data-new-title='$new_title'
            data-new-content='$new_content'
            data-new-image='$new_image'

          >
          <td><img src='$new_image' alt='$new_title' class='table-image'></td>
            <td>$new_title</td>
            <td>$new_content</td>
            <td>$new_date_formated $new_time_formated</td>
            <td>$user_name</td>
        ";
        if($new_author == $userid){
          $response .= "
            <td>
              <button onclick='toggleEditNew(this)' class='table-button small' data-flip-id='animate'>
                <span class='material-symbols-rounded'>edit</span>
              </button>
              <button onclick='toggleDeleteNew(this)' class='table-button small' data-flip-id='animate' ask-confirmation='true'>
                <span class='material-symbols-rounded'>delete</span>
              </button>
            </td>
          ";
        }else{
          if($view_type == "1" || $view_type == "7"){
            if($_SESSION["additional_data"]["permissions"] == "1" || $_SESSION["additional_data"]["permissions"] == "7"){
              $response .= "
                <td>
                  <button onclick='toggleEditNew(this)' class='table-button small' data-flip-id='animate'>
                    <span class='material-symbols-rounded'>edit</span>
                  </button>
                  <button onclick='toggleDeleteNew(this)' class='table-button small' data-flip-id='animate' ask-confirmation='true'>
                    <span class='material-symbols-rounded'>delete</span>
                  </button>
                </td>
              ";
            }
          }
        }

        
      }
      $response .= "</table>";
      $response .= $this->displayPagination($userid, $limit, $offset, $view_type);
      return $response;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  private function displayPagination($userid, $limit, $page, $view_type) {
    $connect=parent::Conection();
    if($view_type == "0"){
      $sql = "SELECT COUNT(*) FROM news WHERE user_id = '$userid';";
    }
    if($view_type == "1" || $view_type == "7"){
      $sql = "SELECT COUNT(*) FROM news;";
    }
    $stmt = $connect->prepare($sql);

    try {
      $stmt->execute();
      $count = $stmt->fetchColumn();
      
      $page_limit = ceil($count / $limit);
      $response = "<psholder>";
      for ($i=0; $i < $page_limit; $i++) { 
        if ($page_limit != 1) {
          if ($page == $i) {
            $response .= "<ps onclick='displayNewsTable($i, $view_type);' class='selected'>".($i+1)."</ps>";
          } else {
            $response .= "<ps onclick='displayNewsTable($i, $view_type);'>".($i+1)."</ps>";
          }
        }
      }
      $response .= "</psholder>";
      return $response;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function getNewsCards(){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = "SELECT news.*, users.name AS author_name 
      FROM news 
      INNER JOIN users ON news.user_id = users.id
      ORDER BY news.new_date DESC
    ";
    
    $stmt = $connect->prepare($sql);

    try {
      $stmt->execute();
      $response = "";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $new_id = $row['id'];
        $new_title = $row['new_title'];
        $new_content = $row['new_content'];
        $new_date = $row['new_date'];
        $new_date_formated = date("d", strtotime($row["new_date"])) . ' ' . $months[date("m", strtotime($row["new_date"]))]. ' ' . date("y", strtotime($row["new_date"]));
        $new_time_formated = date("g:i A", strtotime($row["new_time"]));
        $new_image = $row["new_image"];
        $author_name = $row["author_name"];

        $new_content_shorted = substr($new_content, 0, 100) . "...";
        
        $response .= "
          <new-item
            data-event-id='$new_id'
            data-img='$new_image'
            data-title='$new_title'
            data-description='$new_content'
            data-date='$new_date_formated'    
            data-time='$new_time_formated'
            data-author='$author_name'
          ></new-item>
        ";
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }

}

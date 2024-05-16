<?php
require_once ("../controllers/news.controller.php");
require_once("../config/cookies.php");

class News extends Connect {
    
    function createNew($userid, $new_title, $new_content, $new_date, $new_time, $new_image){
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
}

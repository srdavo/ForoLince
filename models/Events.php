<?php
require_once ("../controllers/events.controller.php");
require_once("../config/cookies.php");

class Events extends Connect {
  public function createNewEvent($userid, $event_name, $event_description, $event_date, $event_time, $event_address, $event_image, $event_credits){
    $connect=parent::Conection();
    $sql = "INSERT INTO events
      (event_name, event_description, event_date, event_time, event_address, event_image, event_credits, user_id)
      VALUES (?,?,?,?,?,?,?,?)
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $event_description, PDO::PARAM_STR);
    $stmt->bindParam(3, $event_date, PDO::PARAM_STR);
    $stmt->bindParam(4, $event_time, PDO::PARAM_STR);
    $stmt->bindParam(5, $event_address, PDO::PARAM_STR);
    $stmt->bindParam(6, $event_image, PDO::PARAM_STR);
    $stmt->bindParam(7, $event_credits, PDO::PARAM_INT);
    $stmt->bindParam(8, $userid, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  
  public function getEvents(){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = "SELECT * FROM events ORDER BY event_date DESC;";
    $stmt = $connect->prepare($sql);

    try {
      $stmt->execute();
      $response = "";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $event_name = $row['event_name'];
        $event_description = $row['event_description'];
        $event_date = $row['event_date'];
        $event_date_formated = date("d", strtotime($row["event_date"])) . ' ' . $months[date("m", strtotime($row["event_date"]))]. ' ' . date("y", strtotime($row["event_date"]));
        $event_time_formated = date("g:i A", strtotime($row["event_time"]));
        $event_address = $row['event_address'];
        $event_image = $row['event_image'];
        $event_credits = $row["event_credits"];
        
        $response .= "
          <card-item
            data-img='$event_image'
            data-credits='$event_credits'
            data-title='$event_name'
            data-description='$event_description'
            data-date='$event_date_formated'    
            data-time='$event_time_formated'
            data-address='$event_address'         
          ></card-item>
        ";
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }

  public function getEventsTable(){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = "SELECT * FROM events ORDER BY event_date DESC;";
    $stmt = $connect->prepare($sql);
    $response = "";
    $table_header="
      <table>
      <tr>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>image</span></td>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>theater_comedy</span>Nombre del evento</td>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>calendar_month</span>Fecha</td>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>schedule</span>Hora</td>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>pin_drop</span>Dirección</td>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>toll</span>Creditos</td>
        <td></td>
      </tr>
    ";
    
    
    try {
      $stmt->execute();
      if ($stmt->rowCount() <= 0) {
        $response = "
          <div class='content_box light centered'>
            <span class='material-symbols-rounded pretty'>search_off</span>
            <h1 class='info'>No hay eventos</h1>
          </div>
        ";
        return $response;
      }
      $response .= $table_header;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $event_id = $row['id'];
        $event_name = $row['event_name'];
        $event_description = $row['event_description'];
        $event_date = $row['event_date'];
        $event_date_formated = date("d", strtotime($row["event_date"])) . ' ' . $months[date("m", strtotime($row["event_date"]))]. ' ' . date("y", strtotime($row["event_date"]));
        $event_time = $row['event_time'];
        $event_time_formated = date("g:i A", strtotime($row["event_time"]));
        $event_address = $row['event_address'];
        $event_image = $row['event_image'];
        $event_credits = $row["event_credits"];
        
        $table_view = "
          <tr 
            data-event-id='$event_id' 
            data-event-img='$event_image'
            data-event-name='$event_name'
            data-event-description='$event_description'
            data-event-date='$event_date'
            data-event-time='$event_time'
            data-event-address='$event_address'
            data-event-credits='$event_credits'
            >
            <td><img src='$event_image' alt='$event_name' class='table-image'></td>
            <td>$event_name</td>
            <td>$event_date_formated</td>
            <td>$event_time_formated</td>
            <td>$event_address</td>
            <td>$event_credits</td>
            <td>
              <button onclick='openEditEventWindow(this)' class='table-button small' data-flip-id='animate'>
                <span class='material-symbols-rounded'>edit</span>
              </button>
              <button data-event-id='$event_id' onclick='deleteEvent(this)' class='table-button small' data-flip-id='animate' ask-confirmation='true'>
                <span class='material-symbols-rounded'>delete</span>
              </button>
            </td>
          </tr>
        ";

        $response .= $table_view;
        
      }
      $response .= "</table>";
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }

  public function editEvent($userid, $event_id, $event_name, $event_description, $event_credits, $event_date, $event_time, $event_address, $event_image){
    $connect=parent::Conection();
    $sql = "UPDATE events
      SET event_name = ?, event_description = ?, event_credits = ?, event_date = ?, event_time = ?, event_address = ?, event_image = ?
      WHERE id = ? AND user_id = ?
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_name, PDO::PARAM_STR);
    $stmt->bindParam(2, $event_description, PDO::PARAM_STR);
    $stmt->bindParam(3, $event_credits, PDO::PARAM_INT);
    $stmt->bindParam(4, $event_date, PDO::PARAM_STR);
    $stmt->bindParam(5, $event_time, PDO::PARAM_STR);
    $stmt->bindParam(6, $event_address, PDO::PARAM_STR);
    $stmt->bindParam(7, $event_image, PDO::PARAM_STR);
    $stmt->bindParam(8, $event_id, PDO::PARAM_INT);
    $stmt->bindParam(9, $userid, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }

  public function deleteEvent($event_id){
    $connect=parent::Conection();
    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}
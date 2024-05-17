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
  
  public function getEvents($date_filter){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = "SELECT * FROM events 
      $date_filter
      ORDER BY event_date DESC
    ;";
    $stmt = $connect->prepare($sql);

    try {
      $stmt->execute();
      $response = "";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $event_id = $row['id'];
        $event_name = $row['event_name'];
        $event_description = $row['event_description'];
        $event_date = $row['event_date'];
        $event_date_formated = date("d", strtotime($row["event_date"])) . ' ' . $months[date("m", strtotime($row["event_date"]))]. ' ' . date("y", strtotime($row["event_date"]));
        $event_time_formated = date("g:i A", strtotime($row["event_time"]));
        $event_address = $row['event_address'];
        $event_image = $row['event_image'];
        $event_credits = $row["event_credits"];

        if($event_date < date("Y-m-d")){
          $hidde_button = "data-hide-button";
        }else{
          $hidde_button = "";
        }
        
        $response .= "
          <card-item
            data-event-id='$event_id'
            data-img='$event_image'
            data-credits='$event_credits'
            data-title='$event_name'
            data-description='$event_description'
            data-date='$event_date_formated'    
            data-time='$event_time_formated'
            data-address='$event_address'    
            $hidde_button     
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
        <td><span class='material-symbols-rounded dynamic fill r-margin'>toll</span>Créditos</td>
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
        $event_completed = $row["event_completed"];

        $options = "Evento completado";
        if($event_completed != 1){
          $options = "
            <button onclick='openEditEventWindow(this)' class='table-button small' data-flip-id='animate'>
              <span class='material-symbols-rounded'>edit</span>
            </button>
            <button data-event-id='$event_id' onclick='deleteEvent(this)' class='table-button small' data-flip-id='animate' ask-confirmation='true'>
              <span class='material-symbols-rounded'>delete</span>
            </button>
            <button data-event-id='$event_id' data-event-name='$event_name' data-event-credits='$event_credits' onclick='toggleEventRegisteredUsers(this)' class='table-button small' data-flip-id='animate'>
              <span class='material-symbols-rounded'>person_check</span>
            </button>
          ";
        }
        
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
              $options
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
  public function registerToEvent($userid, $event_id){
    $connect=parent::Conection();
    $sql = "INSERT INTO event_inscriptions (user_id, event_id) VALUES (?,?)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $userid, PDO::PARAM_INT);
    $stmt->bindParam(2, $event_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function checkIfUserIsRegistered($userid, $event_id){
    $connect=parent::Conection();
    $sql = "SELECT * FROM event_inscriptions WHERE user_id = ? AND event_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $userid, PDO::PARAM_INT);
    $stmt->bindParam(2, $event_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function cancelEventRegistration($userid, $event_id){
    $connect=parent::Conection();
    $sql = "DELETE FROM event_inscriptions WHERE user_id = ? AND event_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $userid, PDO::PARAM_INT);
    $stmt->bindParam(2, $event_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function getEventData($event_id){
    $connect=parent::Conection();
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  
  public function getRegisteredEvents($userid, $completed_filter){
    require_once '../config/utilities.php';
    $connect=parent::Conection();
    $sql = "SELECT events.* FROM events 
        JOIN event_inscriptions ON events.id = event_inscriptions.event_id 
        WHERE event_inscriptions.user_id = ?
        AND events.event_date >= CURDATE() 
        $completed_filter
        ORDER BY events.event_date DESC;";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $userid, PDO::PARAM_INT);
    $response = "";
    
    try {
      $stmt->execute();
      if ($stmt->rowCount() <= 0) {
        $response = "
          <div class='content_box light centered'>
            <span class='material-symbols-rounded pretty'>search_off</span>
            <h1 class='info'>No estás inscrito a ningún evento</h1>
          </div>
        ";
        return $response;
      }
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

        if($completed_filter != "AND events.event_completed != 1"){
          $hidde_button = "data-hide-button";
        }else{
          $hidde_button = "";
        }
        
        $response .= "
          <card-item
            data-event-id='$event_id'
            data-img='$event_image'
            data-credits='$event_credits'
            data-title='$event_name'
            data-description='$event_description'
            data-date='$event_date_formated'    
            data-time='$event_time_formated'
            data-address='$event_address'
            data-flex-basis='auto'     
            data-cancel-button='true'
            $hidde_button
          ></card-item>
        ";
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }
  public function getEventRegisteredUsers($event_id){
    $connect=parent::Conection();
    $sql = "SELECT 
        users.*, 
        event_inscriptions.event_id,
        CASE 
          WHEN event_absences.id IS NULL THEN false 
          ELSE true 
        END AS has_absence
      FROM users 
      JOIN event_inscriptions ON users.id = event_inscriptions.user_id
      LEFT JOIN event_absences ON users.id = event_absences.user_id 
        AND event_inscriptions.event_id = event_absences.event_id
      WHERE event_inscriptions.event_id = ?
      ORDER BY users.name ASC;
    ";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $table_header="
      <table>
      <tr>
        <td><span class='material-symbols-rounded dynamic fill r-margin'>person</span>Usuario</td>
        <td></td>
      </tr>
    ";
    $response = "";
    
    try {
      $stmt->execute();
      if ($stmt->rowCount() <= 0) {
        $response = "
          <div class='content_box light centered'>
            <span class='material-symbols-rounded pretty'>search_off</span>
            <h1 class='info'>No hay usuarios inscritos</h1>
          </div>
        ";
        return $response;
      }
      $response .= $table_header;
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_id = $row['id'];
        $user_name = $row['name'];
        $event_id = $row['event_id'];
        if($row["has_absence"]){
          $check_if_selected = "";
        }else{
          $check_if_selected = "selected";
        }
        
        $response .= "
          <tr>
            <td>$user_name</td>
            <td>
              <md-filled-tonal-icon-button toggle $check_if_selected onclick='setUserEventAbsences(this)' data-user-id='$user_id' data-event-id='$event_id'>
                <md-icon>sentiment_very_dissatisfied</md-icon>
                <md-icon slot='selected'>sentiment_satisfied</md-icon>
              </md-filled-tonal-icon-button>
            </td>
          </tr>
        ";
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }
  public function setUserEventAbsences($event_id, $user_id){
    $connect=parent::Conection();
    $sql = "INSERT INTO event_absences (event_id, user_id) VALUES (?,?)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function checkUserEventAbsences($event_id, $user_id){
    $connect=parent::Conection();
    $sql = "SELECT * FROM event_absences WHERE event_id = ? AND user_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function removeUserEventAbsences($event_id, $user_id){
    $connect=parent::Conection();
    $sql = "DELETE FROM event_absences WHERE event_id = ? AND user_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $user_id, PDO::PARAM_INT);

    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function getRegisteresUsersArray($event_id){
    $connect=parent::Conection();
    $sql = "SELECT * FROM event_inscriptions WHERE event_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $response = [];
    
    try {
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response[] = $row["user_id"];
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  }
  public function getEventAbsencesUsersArray($event_id){
    $connect=parent::Conection();
    $sql = "SELECT * FROM event_absences WHERE event_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_id, PDO::PARAM_INT);
    $response = [];
    
    try {
      $stmt->execute();
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response[] = $row["user_id"];
      }
      return $response;
    } catch (PDOException $e) {
      return "Error: " . $e->getMessage();
    }
  } 
  public function registerAttendance($event_id, $event_credits, $confirmed_alumns_attendance){
    $connect=parent::Conection();
    $sql = "UPDATE users_data SET credits = credits + ? WHERE id IN (".implode(",", $confirmed_alumns_attendance).")";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(1, $event_credits, PDO::PARAM_INT);
    
    try {
      $stmt->execute();
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function completeEvent($event_id){
    $connect=parent::Conection();
    $sql = "UPDATE events SET event_completed = 1 WHERE id = ?";
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
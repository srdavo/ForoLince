<?php
require_once("../config/connect.php");
require_once("../models/Events.php");
require_once("../config/session.php");
$events = new Events();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]) {
  case "createNewEvent":
    $event_name = filter_var($data["event_name"], FILTER_SANITIZE_STRING);
    $event_description = filter_var($data["event_description"], FILTER_SANITIZE_STRING);
    $event_date = filter_var($data["event_date"], FILTER_SANITIZE_STRING);
    $event_time = filter_var($data["event_time"], FILTER_SANITIZE_STRING);
    $event_address = filter_var($data["event_address"], FILTER_SANITIZE_STRING);
    $event_image = filter_var($data["event_image"], FILTER_SANITIZE_STRING);
    $event_credits = filter_var($data["event_credits"], FILTER_SANITIZE_STRING);

    $createNewEvent = $events->createNewEvent($userid, $event_name, $event_description, $event_date, $event_time, $event_address, $event_image, $event_credits);
    if(!$createNewEvent){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "editEvent":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $event_name = filter_var($data["event_name"], FILTER_SANITIZE_STRING);
    $event_description = filter_var($data["event_description"], FILTER_SANITIZE_STRING);
    $event_credits = filter_var($data["event_credits"], FILTER_SANITIZE_STRING);
    $event_date = filter_var($data["event_date"], FILTER_SANITIZE_STRING);
    $event_time = filter_var($data["event_time"], FILTER_SANITIZE_STRING);
    $event_address = filter_var($data["event_address"], FILTER_SANITIZE_STRING);
    $event_image = filter_var($data["event_image"], FILTER_SANITIZE_STRING);

    $editEvent = $events->editEvent($userid, $event_id, $event_name, $event_description, $event_credits, $event_date, $event_time, $event_address, $event_image);
    if(!$editEvent){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "getEvents":
    $date_filter = filter_var($data["date_filter"], FILTER_SANITIZE_STRING);
    if($date_filter == "all"){
      $date_filter = "";
    }elseif ($date_filter == "from_today") {
      $date_filter = "WHERE event_date >= CURDATE() ";
    }
    $getEvents = $events->getEvents($date_filter);
    if(!$getEvents){echo json_encode(false); exit;}
    echo json_encode($getEvents);
    break;
  case "getEventsTable":
    $getEventsTable = $events->getEventsTable();
    if(!$getEventsTable){echo json_encode(false); exit;}
    echo json_encode($getEventsTable);
    break;
  case "deleteEvent":    
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $deleteEvent = $events->deleteEvent($event_id);
    if(!$deleteEvent){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "registerToEvent":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $checkIfUserIsRegistered = $events->checkIfUserIsRegistered($userid, $event_id);
    if($checkIfUserIsRegistered){echo json_encode("already_registered"); exit;}

    $registerToEvent = $events->registerToEvent($userid, $event_id);
    if(!$registerToEvent){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "getRegisteredEvents":
    $completed_filter = filter_var($data["completed_filter"], FILTER_SANITIZE_STRING);
    if($completed_filter == "false"){
      $completed_filter = "AND events.event_completed != 1";
    }elseif ($completed_filter == "true") {
      $completed_filter = "AND events.event_completed = 1 ";
    }
    $getRegisteredEvents = $events->getRegisteredEvents($userid, $completed_filter);
    if(!$getRegisteredEvents){echo json_encode(false); exit;}
    echo json_encode($getRegisteredEvents);
    break;
  case "cancelEventRegistration":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $cancelEventRegistration = $events->cancelEventRegistration($userid, $event_id);
    if(!$cancelEventRegistration){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "getEventRegisteredUsers":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $getEventRegisteredUsers = $events->getEventRegisteredUsers($event_id);
    if(!$getEventRegisteredUsers){echo json_encode(false); exit;}
    echo json_encode($getEventRegisteredUsers);
    break;
  case "setUserEventAbsences":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    $user_id = filter_var($data["user_id"], FILTER_SANITIZE_STRING);

    $checkUserEventAbsences = $events->checkUserEventAbsences($event_id, $user_id);
    if($checkUserEventAbsences){
      $removeUserEventAbsences = $events->removeUserEventAbsences($event_id, $user_id);
      if(!$removeUserEventAbsences){echo json_encode(false); exit;}
      echo json_encode(true);
      exit;
    }

    $setUserEventAbsences = $events->setUserEventAbsences($event_id, $user_id);
    if(!$setUserEventAbsences){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
  case "registerAttendance":
    $event_id = filter_var($data["event_id"], FILTER_SANITIZE_STRING);
    // $user_id = filter_var($data["user_id"], FILTER_SANITIZE_STRING);

    $inscribed_alumnus_array = $events->getRegisteresUsersArray($event_id);
    if(!$inscribed_alumnus_array){echo json_encode("inscribed_alumnus_array failed"); exit;}
    $absences_alumns_array = $events->getEventAbsencesUsersArray($event_id);
    if(!$absences_alumns_array){echo json_encode("absences_alumns_array failed"); exit;}
    $confirmed_alumns_attendance = array_diff($inscribed_alumnus_array, $absences_alumns_array);
    $event_credits = $events->getEventData($event_id)["event_credits"];

    $registerAttendance = $events->registerAttendance($event_id, $event_credits, $confirmed_alumns_attendance);
    if(!$registerAttendance){echo json_encode("registerAttendance failed"); exit;}

    $completeEvent = $events->completeEvent($event_id);




    
    // if(!$registerAttendance){echo json_encode(false); exit;}
    echo json_encode(true);
    break;
}
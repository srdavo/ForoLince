<?php
require_once("../config/connect.php");
require_once("../models/users.php");
require_once("../config/cookies.php");
$users = new users();

if (isset($_GET["cookies"])) {
    if (isset($_COOKIE[$cookie_uid])) {
        $username = $_COOKIE[$cookie_uid];
        $pwd= $_COOKIE[$cookie_pwd];
        $login = $users->login($username, $pwd, $cookie_uid, $cookie_pwd);
        if($login){header("location: ../home");}else{
            header("location: ../index?error=true");
        }
        exit;
    }
}

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]) {
    case 'login':
        $username = $data["user"];
        $pwd = $data["pwd"];
        $login = $users->login($username, $pwd, $cookie_uid, $cookie_pwd);

        if($login){echo json_encode("access_accepted");}
        break;
    case 'signup' :
        $email = htmlspecialchars($data["email"]);
        $pwd = $data["pwd"];
        $signup = $users->signup($email, $pwd);
        if($signup){
            $login = $users->login($email, $pwd, $cookie_uid, $cookie_pwd);
            if($login){echo json_encode("access_accepted");}
        }
        break;
    case 'saveData' :
        $username = htmlspecialchars($data["user_name"]);
        break;
    case 'getUserData' :
        include_once("../config/session.php");
        $user_data = $users->getUserData($userid);
        echo json_encode($user_data);
        break;
    case 'modifyUserData' :
        include_once("../config/session.php");
        $name = htmlspecialchars($data["name"]);
        $modify = $users->modifyUserData($name, $userid);
        if($modify){echo json_encode(true);}
        break;
    case "getAllUsersDataTable":

        require_once("../config/session.php");
        $user_permissions = $_SESSION["additional_data"]["permissions"];
        $getAllUsersDataTable = $users->getAllUsersDataTable($user_permissions);
        if(!$getAllUsersDataTable){echo json_encode($getAllUsersDataTable); exit;}
        echo json_encode($getAllUsersDataTable);
        break;
    case "modifyUserCredits":
        $user_id = $data["user_id"];
        $credits = $data["user_credits"];
        $modifyUserCredits = $users->modifyUserCredits($user_id, $credits);
        if($modifyUserCredits){echo json_encode(true);}else{
            echo json_encode(false);
        }
        break;
    case "modifyUserPermissions":
        require_once("../config/session.php");
        $user_id = $data["user_id"];
        $permissions = $data["user_permissions"];
        $modifyUserPermissions = $users->modifyUserPermissions($userid, $user_id, $permissions);
        if($modifyUserPermissions){echo json_encode(true);}else{
            echo json_encode(false);
        }
        break;
    default:
        # code...
        break;
}
 

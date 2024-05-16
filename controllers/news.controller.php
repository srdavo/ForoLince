<?php
require_once("../config/connect.php");
require_once("../models/News.php");
require_once("../config/session.php");
$news = new News();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]) {
    case 'createNew':
        date_default_timezone_set('America/Mazatlan');
        $new_title = filter_var($data["new_title"], FILTER_SANITIZE_STRING);
        $new_content = filter_var($data["new_content"], FILTER_SANITIZE_STRING);
        $new_date = date("Y-m-d");
        $new_time = date("H:i:s");        
        $new_image = filter_var($data["new_image"], FILTER_SANITIZE_STRING);

        $createNew = $news->createNew($userid, $new_title, $new_content, $new_date, $new_time, $new_image);
        if(!$createNew){echo json_encode(false); exit;}
        echo json_encode(true);
        break;

}
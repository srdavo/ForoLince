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
    case 'getNewsTable':
        $page = filter_var($data["page"], FILTER_SANITIZE_NUMBER_INT);
        $limit = 100;
        $offset = (($page+1) * $limit)-$limit;
        $view_type = filter_var($data["view_type"], FILTER_SANITIZE_STRING);
        if($view_type == "0"){
            $sql_query = "SELECT news.*, users.name AS user_name
                FROM news
                JOIN users ON news.user_id = users.id
                WHERE news.user_id = $userid
                LIMIT ? OFFSET ?;
            ";
        }
        if($view_type == "1" || $view_type == "7"){
            $sql_query = "SELECT news.*, users.name AS user_name
                FROM news
                JOIN users ON news.user_id = users.id
                LIMIT ? OFFSET ?;
            ";
        }

        $getNewsTable = $news->getNewsTable($userid, $sql_query, $view_type, $offset, $limit);
        if(!$getNewsTable){echo json_encode(false); exit;}
        echo json_encode($getNewsTable);
        break;
    case 'editNew':
        $new_id = filter_var($data["new_id"], FILTER_SANITIZE_NUMBER_INT);
        $new_title = filter_var($data["new_title"], FILTER_SANITIZE_STRING);
        $new_content = filter_var($data["new_content"], FILTER_SANITIZE_STRING);
        $new_image = filter_var($data["new_image"], FILTER_SANITIZE_STRING);

        $editNew = $news->editNew($new_id, $new_title, $new_content, $new_image);
        if(!$editNew){echo json_encode(false); exit;}
        echo json_encode(true);
        break;
    case 'deleteNew':
        $new_id = filter_var($data["new_id"], FILTER_SANITIZE_NUMBER_INT);
        $deleteNew = $news->deleteNew($new_id);
        if(!$deleteNew){echo json_encode(false); exit;}
        echo json_encode(true);
        break;
    case "getNewsCards":
        $getNewsCards = $news->getNewsCards();
        if(!$getNewsCards){echo json_encode(false); exit;}
        echo json_encode($getNewsCards);
        break;;


}
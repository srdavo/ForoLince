<?php
require_once("../config/connect.php");
require_once("../models/News.php");
require_once("../config/cookies.php");
$news = new News();

// Data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

switch ($data["op"]) {
    
}
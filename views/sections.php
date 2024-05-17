<?php 

include_once 'views/sections/section-home.php';
include_once 'views/sections/section-news.php';
include_once 'views/sections/section-events.php';



if($_SESSION["additional_data"]["permissions"] == "1" || $_SESSION["additional_data"]["permissions"] == "7"){
    include_once 'views/sections/section-management.php';
    include_once 'views/sections/section-admin-events.php';
    include_once 'views/sections/section-admin-news.php';
    include_once 'views/sections/section-admin-users.php';
}
if($_SESSION["additional_data"]["permissions"] == "7"){
    include_once 'views/sections/section-permissions.php';
}
// include_once 'views/sections/section-permissions.php';
?>






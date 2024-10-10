<?php

session_start();

include("connection.php");
include("functions.php");

if(isset($_SESSION['user_id'])){

    unset($_SESSION['user_id']);
   
}
header("location: login.php");
die;
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = mysqli_connect('localhost','root', '' ,'project_php');

if(mysqli_connect_error()){
    echo 'failed to connect to my MySQL'.mysqli_connect_error();
    exit();
}
<?php
include '../../config/baseurl.php';
include '../../config/db.php';


if(
    isset($_POST['email']) && strlen($_POST['email']) > 0 &&
    isset($_POST['password']) && strlen($_POST['password']) > 0 
){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check_user = mysqli_query($con,"SELECT * FROM  users WHERE email = '$email'");
  

    
if(mysqli_num_rows($check_user) == 0){
    header("Location:$BASE_URL/login.php?error=5");
    exit();
}

$hash = sha1($password);
// переводим данные бд в массив
$user = mysqli_fetch_assoc($check_user);
if($hash != $user['password']){
    header("Location:$BASE_URL/login.php?error=6");
    exit();
}
//сохранения данных в сессии
session_start();
$_SESSION['nickname'] = $user['nickname'];
$_SESSION['id'] = $user['id'];
//'Hello'.$name
header("Location:$BASE_URL/profile.php?nickname=".$user["nickname"]);


}
else{
    //перенаправление пользователя используется функция header
    header("Location:$BASE_URL/login.php?error=4");
    exit();
}   
<?php
include '../../config/baseurl.php';
include '../../config/db.php';


if(
    isset($_POST['email']) && strlen($_POST['email']) > 0 &&
    isset($_POST['full_name']) && strlen($_POST['full_name']) > 0 &&
    isset($_POST['nickname']) && strlen($_POST['nickname']) > 0 &&
    isset($_POST['password']) && strlen($_POST['password']) > 0 &&
    isset($_POST['password2']) && strlen($_POST['password2']) > 0 
){
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


if($password !== $password2){
    header("Location:$BASE_URL/register.php?error=2");
    exit();
}

//             запрос в БД       получить(* - все данные) с таблицы юзер где email равно email
$check_user = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");

if(mysqli_num_rows($check_user) == 1){
    header("Location:$BASE_URL/register.php?error=3");
    exit();
}

//      хэширование пароля
$hash = sha1($password);
mysqli_query($con, "INSERT INTO users(email, full_name, nickname, password)
VALUES('$email','$full_name','$nickname','$hash')");
    header("Location:$BASE_URL/login.php");

}
else{
    //перенаправление пользователя используется функция header
    header("Location:$BASE_URL/register.php?error=1");
    exit();
}   
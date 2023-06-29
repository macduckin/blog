<?php 
include '../../config/baseurl.php';
include '../../config/db.php';

if(isset($_POST["title"],$_POST["description"],$_POST["category_id"]) &&
strlen($_POST["title"]) > 0 &&
strlen($_POST["description"]) > 0 &&
strlen($_POST["category_id"]) > 0
){

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $categ_id = $_POST["category_id"];

    session_start();
    $user_id = $_SESSION["id"];


    if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 0){
        //               explode                end
    //  "picture.jpg => ["picture","jpg"] => $ext = "jpg"
    // picture.jpg => time() =>2121312312313.jpg
        $ext = end(explode('.', $_FILES["image"]["name"]));
        $image_name = time().'.'.$ext;


        move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/blogs/$image_name");
        $path = "images/blogs/$image_name";

        mysqli_query($con, "INSERT INTO blogs (title, description, category_id, user_id, image) 
        VALUES('$title', '$desc', '$categ_id', '$user_id', '$path')");

}
else{
    mysqli_query($con, "INSERT INTO blogs (title, description, category_id, user_id) 
    VALUES('$title', '$desc', '$categ_id', '$user_id')");

}
$nickname = $_SESSION["nickname"];
header("Location:$BASE_URL/profile.php?nickname=$nickname");

}
else{
    header("Location:$BASE_URL/newblog.php?error=7");
}
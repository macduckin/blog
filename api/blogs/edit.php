<?php 
include '../../config/baseurl.php';
include '../../config/db.php';


$blog_id = $_POST["blog_id"];

if(isset($_POST["title"],$_POST["description"],$_POST["category_id"], $_POST["blog_id"]) &&
strlen($_POST["title"]) > 0 &&
strlen($_POST["description"]) > 0 &&
intval($_POST["category_id"]) > 0 &&
intval($_POST["blog_id"])
){

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $categ_id = $_POST["category_id"];

    session_start();
    $user_id = $_SESSION["id"];


    if(isset($_FILES["image"]) && strlen($_FILES["image"]["name"]) > 0){
      $query = mysqli_query($con,"SELECT image FROM blogs WHERE id = 'blog_id'");
      if(mysqli_num_rows($query) > 0 ){
        $row =  mysqli_fetch_assoc($query);
        $old_path = __DIR__."/../../".$row["image"];
        if(file_exists($old_path)){
            unlink($old_path);
        }
      }

        $ext = end(explode('.', $_FILES["image"]["name"]));
        $image_name = time().'.'.$ext;


        move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/blogs/$image_name");
        $path = "images/blogs/$image_name";

        mysqli_query($con, "UPDATE blogs SET title = '$title', description = '$desc',
         category_id = '$categ_id', image = '$path' WHERE id = '$blog_id' ");

}
else{
    mysqli_query($con, "UPDATE blogs SET title = '$title', description = '$desc',
         category_id = '$categ_id'  WHERE id = '$blog_id' ");

}
$nickname = $_SESSION["nickname"];
header("Location:$BASE_URL/profile.php?nickname=$nickname");

}
else{
    header("Location:$BASE_URL/editblog.php?error=8&id=$blog_id");
}
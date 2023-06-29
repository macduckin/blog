<?php
include 'config/baseurl.php';
include 'config/db.php';

$limit = 3;

$sql = "SELECT b.*, u.nickname, c.name FROM blogs b INNER JOIN users u ON b.user_id = u.id INNER JOIN categories  c ON  b.category_id = c.id";
//                                    обращение
$sql_count = "SELECT CEIL(COUNT(*) / $limit) as total  FROM blogs b INNER JOIN users u ON b.user_id = u.id INNER JOIN categories  c ON  b.category_id = c.id";

$category = null;
if(isset($_GET["category"]) && intval($_GET["category"])){
	$category = $_GET["category"];
	$sql.=" WHERE b.category_id = $category";
	$sql_count.=" WHERE b.category_id = $category";

}

$search = null;
if(isset($_GET["search"])){
$search = $_GET["search"];
//         ASD -> asd == asd(с базы данных)
//        Программирование -> рограм == рограм(с базы данных)
//                                  autotype
$sql.=" WHERE LOWER(b.title) LIKE '%$search%' OR LOWER(u.nickname) LIKE '%$search%'
OR LOWER(b.description) LIKE '%$search%'";

$sql_count.=" WHERE LOWER(b.title) LIKE '%$search%' OR LOWER(u.nickname) LIKE '%$search%'
OR LOWER(b.description) LIKE '%$search%'";
}
// 30 / 3 = 10
// 1 : 3
// 2 : 3
// 3 : 3
// page - 1 * limit = skip
// (2 - 1) * 3 = 3
$page = 1;
if(isset($_GET["page"]) && intval($_GET["page"])){
	$skip =  ($_GET["page"] - 1) * $limit;
	$sql.= " LIMIT $skip, $limit";
}
else{
	$sql.= " LIMIT $limit";
}
//     info
$blogs = mysqli_query($con, $sql);
//    sum of pages
$counts = mysqli_query($con, $sql_count);
$count = mysqli_fetch_assoc($counts);


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Главная</title>
	<?php include 'views/head.php'; ?>

</head>
<body>
<?php include 'views/header.php'; ?>


<section class="container page">
	<div class="page-content">
			<h2 class="page-title">Блоги по программированию</h2>
			<p class="page-desc">Популярные и лучшие публикации по программированию для начинающих
 и профессиональных программистов и IT-специалистов.</p>

		<div class="blogs">
		<?php 
    // $blogs = mysqli_query($con, "SELECT b.*, u.nickname, c.name FROM blogs b INNER JOIN users u ON b.user_id = u.id INNER JOIN categories  c ON  b.category_id = c.id");
    if(mysqli_num_rows($blogs) > 0){
     while($blog = mysqli_fetch_assoc($blogs)){
   
   ?>

			<div class="blog-item">
				<img class="blog-item--img" src="<?= $blog["image"]?>" alt="">
				<div class="blog-header">
					<h3><?= $blog["title"]?></h3>
				</div>
				<p class="blog-desc">
				<?= $blog["description"]?>
				</p>
				<p class="blog-desc">
				<?= $blog["name"]?>
				</p>
				<div class="blog-info">
					<span class="link">
						<img src="images/date.svg" alt="">
						22.12.21
					</span>
					<span class="link">
						<img src="images/visibility.svg" alt="">
						21
					</span>
					<a class="link">
						<img src="images/message.svg" alt="">
						4
					</a>
					<span class="link">
						<img src="images/forums.svg" alt="">
						23
					</span>
					<a class="link" href="<?= $BASE_URL?>/profile.php?nickname=<?=$blog["nickname"]?>">
						<img src="images/person.svg" alt="">
						<?= $blog["nickname"]?>
					</a>
				</div>
			</div>

			<?php 
	} }else{
?>
			<h3>0 blogs</h3>
			<?php } ?>
		</div>
	</div>
	<div class="page-info">
				<div class="page-header">
					<h2>Категории</h2>
				</div>
				<?php 
				$categories = mysqli_query($con,"SELECT * FROM categories");
				if(mysqli_num_rows($categories) > 0){
					while($categ = mysqli_fetch_assoc($categories)){
						?>
				<a class ="list-item" href="<?= $BASE_URL ?>/?category=<?=$categ["id"]?>"> <?= $categ["name"]?></a>
				<?php
					}
				}
					?>
			</div>
		</div>
		<div class="pagination">
			<?php 
			$page = $_GET["page"];
			if($page != 1){
				?>

			<a href="<?= $BASE_URL?>/?page=<?= $page - 1?>">prev</a>

			<?php }
			?>
			<?php 
			for($i = 0; $i < $count["total"]; $i++){
			?>

			<a href="<?= $BASE_URL?>/?page=<?= $i + 1?>"><?= $i + 1?></a>
			<?php
		 }
		 if($page != $count["total"]){
			?>
			<a href="<?= $BASE_URL?>/?page=<?= $page + 1?>">next</a>

		<?php }?>
		</div>
</section>	
</body>
</html>
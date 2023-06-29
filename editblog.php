
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Редактировать блог</title>
    <?php include 'views/head.php'; ?>

</head>
<body>
<?php include 'views/header.php'; ?>

	<section class="container page">
		<div class="page-block">

			<div class="page-header">
				<h2>Редактировать блог</h2>
			</div>
			<form class="form" action="api/blogs/edit.php" method="POST" enctype="multipart/form-data" > 
				<?php 
				$blog_id = $_GET["id"];
				$blogs_info = mysqli_query($con, "SELECT * FROM blogs WHERE id = '$blog_id'");
				if(mysqli_num_rows($blogs_info) > 0){
					$blog_info = mysqli_fetch_assoc($blogs_info);
				
				?>
				<fieldset class="fieldset">
					<input class="input" type="text" name="title" placeholder="Заголовок" value="<?= $blog_info["title"]?>">
				</fieldset>

				<fieldset class="fieldset">
				<select name="category_id" id="" class="input">
				<?php 
				$categories = mysqli_query($con,"SELECT * FROM categories");
				if(mysqli_num_rows($categories) > 0){
					while($categ = mysqli_fetch_assoc($categories)){
						if($categ["id"] ==  $blog_info["category_id"]){
						?>
					<option value="<?=$categ["id"]?>" selected> <?= $categ["name"]?></option>
					<?php
					}else{ ?>
					
					<option value="<?=$categ["id"]?>"><?=$categ["name"]?></option>

					<?php
					}
				}
			}
			?>

			<input type="hidden" name="blog_id" value="<?=$blog_id?>">
				</select>
			</fieldset class="fieldset">

				<fieldset class="fieldset">
					<button class="button button-yellow input-file">
						<input type="file" name="image">	
						Выберите картинку
					</button>
				</fieldset>
					
				<fieldset class="fieldset">
					<textarea class="input input-textarea" name="description" id="" cols="30" rows="10" placeholder="Описание"><?= $blog_info["description"]?></textarea>
				</fieldset>
				<fieldset class="fieldset">
					<button class="button" type="submit">Сохранить</button>
				</fieldset>
				<?php } ?>
			</form>

			<?php 
			if(isset($_GET["error"]) && $_GET["error"] == 8){
			?>
				<p class="text-danger"> Заголовок и Описание не могут быть пустыми!</p>
			<?php } ?>

		</div>

	</section>
	
	

	
	
</body>
</html>

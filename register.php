<!DOCTYPE html>
<html lang="en">
<head>
	<title>Регистрация в систему</title>
    <?php include 'views/head.php'; ?>

</head>
<body>
<?php include 'views/header.php'; ?>

	<section class="container page">
		<div class="auth-form">
            <h1>Регистрация</h1>
			<form class="form" action="api/users/signup.php" method="POST">
                <fieldset class="fieldset">
                    <input class="input" type="text" name="email" placeholder="Введите email">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="text" name="full_name" placeholder="Полное имя">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="text" name="nickname" placeholder="Nickname">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password" placeholder="Введите пароль">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password2" placeholder="Подтвердить пароль">
                </fieldset>

                <fieldset class="fieldset">
                    <button class="button" type="submit">Зарегистрироваться</button>
                </fieldset>
			</form>

        <?php 

        if(isset($_GET["error"]) &&  $_GET["error"] == 1){

            ?>
            <p style = "color:red;">fill the gaps</p>

            <?php

        }else if(isset($_GET["error"]) && $_GET["error"] == 3){

            ?>
                <p style = "color:red;">this user  exist</p>


            <?php 

            }else if(isset($_GET["error"]) && $_GET["error"] == 2){

                ?>

            <p style = "color:red;">passwords is not same</p>


                <?php } ?>
		</div>
	</section>
</body>
</html>
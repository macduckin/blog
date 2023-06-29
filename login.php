<!DOCTYPE html>
<html lang="en">
<head>
    <title>Войти в систему</title>
    <?php include 'views/head.php'; ?>

</head>
<body>
<?php include 'views/header.php'; ?>

	<section class="container page">
		<div class="auth-form">
            <h1>Вход</h1>
			<form class="form" action='api/users/signin.php' method = "POST">
                <fieldset class="fieldset" >
                    <input class="input" type="text" name="email" placeholder="Введите email">
                </fieldset>
                <fieldset class="fieldset">
                    <input class="input" type="password" name="password" placeholder="Введите пароль">
                </fieldset>

                <fieldset class="fieldset">
                    <button class="button" type="submit">Войти</button>
                </fieldset>
			</form>
            <?php 

if(isset($_GET["error"]) &&  $_GET["error"] == 4){

    ?>
    <p style = "color:red;">fill the gaps</p>

    <?php

}else if(isset($_GET["error"]) && $_GET["error"] == 5){

    ?>
        <p style = "color:red;">password or login isnt correct</p>


    <?php 

    }else if(isset($_GET["error"]) && $_GET["error"] == 6){

        ?>

    <p style = "color:red;">password  or login isnt correct</p>


        <?php } ?>
		</div>
	</section>
</body>
</html>
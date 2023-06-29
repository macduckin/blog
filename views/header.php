<?php
include "config/baseurl.php";
include "config/db.php";
session_start();
?>

<header class="header container">
      <div class="header-logo">
        <a href="<?=$BASE_URL?>/">Decode blog</a>
      </div>
      <form class="header-search" action="<?=$BASE_URL?>/" method="GET">
        <input type="text" class="input-search" placeholder="Поиск по блогам" name="search" />
        <button class="button button-search">
          <img src="images/search.svg" alt="" />
          Найти
        </button>
</form>
      <div>

      <?php 
      if (isset($_SESSION['nickname'])){ ?>
      <script>
        localStorage.setItem('nickname','<?=$_SESSION["nickname"]?>');
        localStorage.setItem('user_id','<?=$_SESSION["id"]?>');

      </script>

        <a href="<?=$BASE_URL?>/profile.php?nickname=<?=$_SESSION['nickname']?>">
            <img class="avatar" src="images/avatar.png" alt="Avatar">
        </a>
      <?php
       }
      else{
        ?>
         <script>
        localStorage.removeItem('nickname');
        localStorage.removeItem('user_id');

      </script>
        <div class="button-group">
          <a href="<?= $BASE_URL ?>/register.php" class="button">Регистрация</a>
          <a href="<?= $BASE_URL ?>/login.php" class="button">Вход</a>
        </div>
        <?php } ?>
      </div>
    </header>
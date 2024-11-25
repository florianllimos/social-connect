<?php

  require_once("composants/database.php");

  require_once("composants/user-connected.php");
  
  require_once("composants/header.php");

  $sql = "SELECT * FROM users";
  $query = $db->prepare($sql);
  $query->execute();
  $account_users = $query->fetchAll();

?>

<div class="show-account">
  <?php 
    foreach($account_users as $account_user):
      $account_id = $account_user["id"];
  ?>
  <div class="account">
    <a href="account_details.php?id=<?= $account_id ?>" class="link-profil">
      <img src="media/profil.png" alt="Photo de compte" class="logo-account">
      <p class="name-account"><?= $account_user["lastname"] . '<br />' . $account_user["firstname"] ?></p>
    </a>
  </div>
  <?php
    endforeach;
  ?>  
</div>

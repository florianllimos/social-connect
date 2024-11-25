<?php

require_once("composants/database.php");

require_once("composants/header.php");

require_once("composants/user-connected.php");

require_once("header-connected.php");

$id = $_SESSION["id"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$birthday = $_SESSION["birthday"];
$country = $_SESSION["country"];
$city = $_SESSION["city"];

if(!empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["email"]) && !empty($_POST["birthday"]) && !empty($_POST["country"]) && !empty($_POST["city"])){

  $lastname = htmlspecialchars($_POST["lastname"]);
  $firstname = htmlspecialchars($_POST["firstname"]);
  $email = htmlspecialchars($_POST["email"]);
  $birthday = htmlspecialchars($_POST["birthday"]);
  $country = htmlspecialchars($_POST["country"]);
  $city = htmlspecialchars($_POST["city"]);

  if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday, country = :country, city = :city WHERE id = :id";

    $query = $db->prepare($sql);

    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->bindValue(":birthday", $birthday, PDO::PARAM_STR);
    $query->bindValue(":country", $country, PDO::PARAM_STR);
    $query->bindValue(":city", $city, PDO::PARAM_STR);

    $query->execute();

    if($query->execute()){

      echo "<h2 class='success'>Vos changement ont été prit en compte avec succès</h2>";

    } else {

      echo "<h2 class='error'>Une erreur est survenue lors de la modification de votre profil</h2>";

    }

  } else {

    echo "<h2 class='error'>Une erreur est survenue lors de la modification de votre profil</h2>";

  } 

}

?>

<div class="container-private">
  <div class="account-info-private">
    <img src="media/profil.png" alt="Logo de compte" class="account-img">
    <ul class="ul-account">
      <hr class="separator-account">
      <li><?= $lastname . ' ' . $firstname ?></li>
      <hr class="separator-account">
      <li><?= $email ?></li>
      <hr class="separator-account">
      <li><?= $birthday ?></li>
      <hr class="separator-account">
      <li><?= $country ?></li>
      <hr class="separator-account">
      <li><?= $city ?></li>
    </ul>
  </div>
  <form method="POST" class="form-private">
    <div class="bloc-form">
      <input type="text" name="lastname" value="<?= $lastname ?>">
    </div>
    <div class="bloc-form">
      <input type="text" name="firstname" value="<?= $firstname ?>">
    </div>
    <div class="bloc-form">
      <input type="email" name="email" value="<?= $email ?>">
    </div>
    <div class="bloc-form">
      <input type="date" name="birthday" value="<?= $birthday ?>">
    </div>
    <div class="bloc-form">
      <input type="text" name="country" value="<?= $country ?>">
    </div>
    <div class="bloc-form">
      <input type="text" name="city" value="<?= $city ?>">
    </div>
    <button type="submit" class="btn-login">Modifier mon profil</button>
  </form>
</div>
<?php

require_once("composants/header.php");

  if (!empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["birthday"]) && !empty($_POST["country"]) && !empty($_POST["city"])) {

    require_once("composants/database.php");

    $lastname = strip_tags($_POST["lastname"]);
    $firstname = strip_tags($_POST["firstname"]);
    $email = strip_tags($_POST["email"]);
    $password = strip_tags($_POST["password"]);
    $confirm_password = strip_tags($_POST["confirm_password"]);
    $birthday = strip_tags($_POST["birthday"]);
    $country = strip_tags($_POST["country"]);
    $city = strip_tags($_POST["city"]);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      if ($password == $confirm_password) {

        $check_email = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        $query_check = $db->prepare($check_email);
        $query_check->bindValue(":email", $email, PDO::PARAM_STR);
        $query_check->execute();
        $result = $query_check->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {

          $password = hash('sha256', $password);

          $create_account = "INSERT INTO users(`lastname`, `firstname`, `email`, `password`, `birthday`, `country`, `city`) VALUES (:lastname, :firstname, :email, :password, :birthday, :country, :city)";
          $query = $db->prepare($create_account);

          $query->bindValue(":lastname", $lastname, PDO::PARAM_STR);
          $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
          $query->bindValue(":email", $email, PDO::PARAM_STR);
          $query->bindValue(":password", $password, PDO::PARAM_STR);
          $query->bindValue(":birthday", $birthday, PDO::PARAM_STR);
          $query->bindValue(":country", $country, PDO::PARAM_STR);
          $query->bindValue(":city", $city, PDO::PARAM_STR);

          $query->execute();

          if($query->execute()){
            echo "<h2 class='success'>Votre compte a bien été créé !</h2>";
          }

        } else {

          echo "<h2 class='error'>Cette adresse e-mail est déjà utilisée.</h2>";

        }

      } else {

        echo "<h2 class='error'>Les mots de passe ne sont pas identique</h2>";

      }

    } 

  }

?>

<div class="container-index">
  <div class="index">
    <h1 class="title">Social Connect</h1>
    <p>Avec Social Connect, partagez et restez en contact avec votre entourage.</p>
  </div>
  <form method="POST" class="form-account">
    <div class="bloc-form">
      <input type="text" name="firstname" placeholder="Nom de famille" required>
    </div>
    <div class="bloc-form">
      <input type="text" name="lastname" placeholder="Prénom" required>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" placeholder="Votre adresse e-mail" required>
    </div>
    <div class="bloc-form">
      <input type="password" name="password" placeholder="Mot de passe">
    </div>
    <div class="bloc-form">
      <input type="password" name="confirm_password" placeholder="Confirmer mot de passe" required>
    </div>
    <div class="bloc-form">
      <input type="date" name="birthday" placeholder="Date de naissance" required>
    </div>
    <div class="bloc-form">
      <input type="text" name="country" placeholder="Pays de résidence" required>
    </div>
    <div class="bloc-form">
      <input type="text" name="city" placeholder="Ville de résidence" required>
    </div>
    <div class="bloc-form">
      <button type="submit" name="submit" class="btn-create">Créer mon compte</button>
    </div>
    <hr class="separator">
    <div class="bloc-form">
      <button class="btn-login" onClick="window.location.href = 'index.php'">Connexion</button>
    </div>
  </form>
</div>

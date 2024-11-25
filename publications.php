<?php

require_once("composants/user-connected.php");

require_once("composants/header.php");

require_once("composants/database.php");

require_once("header-connected.php");

if(!empty($_POST["title"]) && !empty($_POST["author"]) && !empty($_POST["content"])) {

  $title = htmlspecialchars($_POST["title"]);
  $author = htmlspecialchars($_POST["author"]);
  $content = htmlspecialchars($_POST["content"]);

  $add_publication = "INSERT INTO `publication`(`title`, `author`, `content`) VALUES (:title, :author, :content)";

  $query = $db->prepare($add_publication);

  $query->bindValue(":title", $title, PDO::PARAM_STR);
  $query->bindValue(":author", $author, PDO::PARAM_STR);
  $query->bindValue(":content", $content, PDO::PARAM_STR);

  $query->execute();

} 

?>

<form method="POST" class="form-publication">
  <div class="bloc-form">
    <input type="text" name="title" placeholder="Titre de la publication" required>
  </div>
  <div class="bloc-form">
    <input type="text" name="author" value="<?= $_SESSION["lastname"] . ' ' . $_SESSION["firstname"] ?>" required readonly>
  </div>
  <div class="bloc-form">
    <textarea name="content" rows="10" required placeholder="Votre contenu"></textarea>
  </div>
  <button type="submit" class="btn-login">Publier</button>
</form>
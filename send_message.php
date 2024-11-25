<?php
  require_once("composants/user-connected.php");
  require_once("composants/database.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $message = $_POST["message"];

  if(isset($_POST["message"]) && !empty($_POST["message"])) {

    $author = $_SESSION["lastname"] . ' ' . $_SESSION["firstname"];
  
    $message = htmlspecialchars($_POST["message"]);
  
    $send_message = "INSERT INTO messages(`author`, `content`) VALUES (:author, :content)"; 
    $new_query = $db->prepare($send_message);
    $new_query->bindValue(":author", $author, PDO::PARAM_STR);
    $new_query->bindValue(":content", $message, PDO::PARAM_STR);
  
    $new_query->execute();
  
  }

}
?>

<?php
  require_once("composants/user-connected.php");
  require_once("composants/database.php");

$sql = "SELECT * FROM messages";
$query = $db->prepare($sql);
$query->execute();
$messages = $query->fetchAll();

foreach ($messages as $message) {
  echo "<div class='message-box'>";
  echo '<p>' . $message["content"] . '</p>';
  echo "<hr class='separator-message'>";
  echo '<p class="message-author">' . $message["author"] . '</p>';
  echo "</div>";
}
?>
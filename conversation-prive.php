<?php

require_once("composants/database.php");

require_once("composants/header.php");

require_once("header-connected.php");

require_once("composants/user-connected.php");


$sql = "SELECT* FROM messages";
$query = $db->prepare($sql);
$query->execute();
$messages = $query->fetchAll();


?>

<div class="container-conversation" id="container-conversation">
  <?php foreach($messages as $message): ?>

  <?php endforeach; ?>
</div>
<div class="send-message">
  <form method="POST" class="send">
    <textarea rows="5" name="message" placeholder="Ecrivez votre message ici .."></textarea>
    <button type="submit" class="btn-login">Envoyer</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function loadMessages() {
    $.ajax({
      url: "load_messages.php", 
      type: "GET",
      success: function(data) {
        $("#container-conversation").html(data);
      }
    });
  }

  $(document).ready(function() {
    loadMessages();
  });

  $("form.send").submit(function(event) {
    event.preventDefault(); 

    var message = $("textarea[name=message]").val();

    $.ajax({
      url: "send_message.php", 
      type: "POST",
      data: { message: message },
      success: function() {
        
        loadMessages();

        $("textarea[name=message]").val("");
      }
    });
  });
</script>

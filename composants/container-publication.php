<?php

  require_once("database.php");

  require_once("header.php");

  $sql = "SELECT * FROM publication";
  $query = $db->prepare($sql);
  $query->execute();
  $publications = $query->fetchAll();

?>

<div class="container-publication">

<?php foreach ($publications as $publication): ?>

  <div class="box">
    <div class="content-publication">
      <h3 class="title-publication"><?= $publication["title"] ?></h3>
      <p class="text-publication"><?= $publication["content"] ?></p>
      <hr class="separator">
      <div class="bottom-publication">
        <span class="author">| <?= $publication["author"] ?> |</span>
        <img src="media/coeur.png" class="heart" alt="heart">
      </div>
    </div>
  </div>
  
  <?php endforeach; ?>
  

</div>

<script>
  const boxes = document.querySelectorAll('.box');
window.addEventListener('scroll', checkBoxes);
checkBoxes();

function checkBoxes() {
	const triggerBottom = window.innerHeight / 5 * 4;
	boxes.forEach((box, idx) => {
		const boxTop = box.getBoundingClientRect().top;
		
		if(boxTop < triggerBottom) {
			box.classList.add('show');
		} else {
			box.classList.remove('show');
		}
	});
}

</script>
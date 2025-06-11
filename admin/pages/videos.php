
<div class="supports">
<?php 
$id_classe = $_GET['id_classe'];
?>

<h2>Liste des capsules vidéos</h2>
<div class="capsules-container">
  <?php if (count($videos) > 0):
    foreach ($videos as $video): ?>
    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 1">
      <div class="capsule-content">
        <h3><?= htmlspecialchars($video['titre_video']) ?></h3>
        <p>
          <?= htmlspecialchars(mb_strimwidth($video['description_video'], 0, 60, '...')) ?>
        </p>
        <a href="video.php?page3=video-view&id_classe=<?= $id_classe ?>&id_video=<?= $video['id_video'] ?>">Voir la capsule</a>

      </div>
    </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aucune capsule vidéo n'a été ajoutée à cette classe</p>
  <?php endif; ?>

</div>
</div>
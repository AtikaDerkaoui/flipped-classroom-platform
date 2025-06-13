
<div class="supports">
<h1>Ajouter une capsule vidéo</h1>
<!-- Formulaire pour ajouter un nouveau support -->
<div class="form-container">
<form action="/Memoire/actions/addVideo.php" method="post" enctype="multipart/form-data" class="space-between form">
    <label for="titre_video">Titre de la capsule vidéo: </label>
    <input type="text" name="titre_video" placeholder="Ex: Les fonctions - Introduction" required>

    <label for="description_video">Description de la vidéo (Optionnel) : </label>
    <input type="text" name="description_video" placeholder="La description">

    <label for="fichier_url_video">Fichier :</label>
    <input type="file" name="fichier_url_video" id="fichier_url_video" class="custom-file-input" required>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <button type="submit">Ajouter la capsule</button>

    <?php
      // Vérifier s'il y a un message en session et l'afficher
      if (isset($_SESSION['message'])) {
        echo "<p class='session-message'>".$_SESSION['message']."</p>";
    
        // Supprimer le message après l'affichage
        unset($_SESSION['message']);
      }
    ?>
</form>
</div>

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
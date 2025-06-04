<div class="supports">
<h1>Ajouter une capsule vidéo</h1>
<!-- Formulaire pour ajouter un nouveau support -->
<form action="/Memoire/actions/addSupport.php" method="post" enctype="multipart/form-data" class="space-between form">
    <label for="titre_support">Titre de la capsule vidéo: </label>
    <input type="text" name="titre_support" placeholder="Ex: Les fonctions - Introduction" required>

    <label for="fichier_url_support">Fichier :</label>
    <input type="file" name="fichier_url_support" id="fichier_url_support" class="custom-file-input" required>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <button type="submit">Ajouter la capsule</button>
</form>

<?php 
$id_classe = $_GET['id_classe'];
?>

<h2>Liste des capsules vidéos</h2>
<div class="capsules-container">

    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 1">
      <div class="capsule-content">
        <h3>Introduction à l’analyse</h3>
        <p>Une capsule sur les notions de limite, continuité et dérivabilité.</p>
        <a href="video-feedback.php?page3=video">Voir la capsule</a>
      </div>
    </div>

    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 2">
      <div class="capsule-content">
        <h3>Suites numériques</h3>
        <p>Comportement asymptotique, suites croissantes et bornées.</p>
        <a href="video-feedback.php?page3=video">Voir la capsule</a>
      </div>
    </div>

    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 2">
      <div class="capsule-content">
        <h3>Suites numériques</h3>
        <p>Comportement asymptotique, suites croissantes et bornées.</p>
        <a href="video-feedback.php?page3=video">Voir la capsule</a>
      </div>
    </div>

    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 2">
      <div class="capsule-content">
        <h3>Suites numériques 2</h3>
        <p>Comportement asymptotique, suites croissantes et bornées.</p>
        <a href="video-feedback.php?page3=video">Voir la capsule</a>
      </div>
    </div>

    <div class="capsule">
      <img src="/Memoire/assets/img/capsule.jpg" alt="Capsule 2">
      <div class="capsule-content">
        <h3>Suites numériques</h3>
        <p>Comportement asymptotique, suites croissantes et bornées.</p>
        <a href="video-feedback.php?page3=video">Voir la capsule</a>
      </div>
    </div>
    <!-- Ajoute d'autres capsules ici -->

</div>
</div>
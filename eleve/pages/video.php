<?php
session_start();
require_once '../../connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: ../../pages/login.php");
    exit();
}

$page3 = $_GET['page3'] ?? ''; // page actuelle
$id_classe = $_GET['id_classe'];
$id_video = $_GET['id_video'];

/* Identifiants manquants */
if (!$id_classe || !$id_video) {
  echo "<p>Erreur : identifiant de la classe ou de la video manquant ou invalide.</p>";
  exit;
}
/* Détails de la video */
$stmt = $conn->prepare("SELECT * FROM videos WHERE id_classe = :id_classe AND id_video = :id_video");
$stmt->execute([
    'id_classe' => $id_classe,
    'id_video' => $id_video
]);
$video = $stmt->fetch(PDO::FETCH_ASSOC);
          
// Sécurité : si la vidéo n’existe pas
if (!$video) {
  echo "<p>Vidéo introuvable.</p>";
  exit;
}

// Le head
$titre = "DzDucation - Vidéo et feedback"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');
?>

<body>
  <?php // require_once(__DIR__.'/../includes/header-enseignant.php');
     require_once(__DIR__.'/../../includes/header-enseignant.php');
  ?>

  <div class="dashboard-container">
    <!-- ============= Navbar de bienvenu ============= -->
    <section class="bienvenu-navbar space-between">
        <h3 class="left-part"><a href="javascript:history.back()">Retour</a></h3>
      
        <h3><a href="#" class="right-part">Guide d'utilisation</a></h3>
    </section>

    <!-- ============= Dashboard ============= -->
    <section class="dashboard space-between">
      <!-- Left part: Side Navbar -->
      <div class="left-part">
        <ul class="flex-centered">
          <li class="side-navbar-header">
            <h4><i class="fa-solid fa-video"></i> <?= htmlspecialchars($video['titre_video']) ?></h4>
            <?php
            $date = new DateTime($video['date_ajout_video']);
            echo "<p>Ajouté le: " . $date->format('d/m/Y') . "</p>"; // ou 'Y-m-d' selon ton format préféré
            ?>
          </li>
          <li><a href="video.php?page3=video-view&id_classe=<?= $id_classe ?>&id_video=<?= $id_video ?>" class="<?= $page3 == 'video-view' ? 'active' : '' ?>">Capsule Vidéo</a></li>
          <li><a href="video.php?page3=video-feedback&id_classe=<?= $id_classe ?>&id_video=<?= $id_video ?>" class="<?= $page3 == 'video-feedback' ? 'active' : '' ?>">Feedback</a></li>
        </ul>
      </div>

      <!-- Right part: Contenu -->
      <div class="right-part">

      <?php 
      switch ($page3) {
            case 'video-feedback':
              require_once(__DIR__.'/quizz-standard.php');
              break;
            case 'video-view':
            default: ?>
              <div class="video space-between">
                <div class="left-part-video">
                  <h2><?= htmlspecialchars($video['titre_video']) ?></h2>
                  <div class="video-container">
                    <video controls>
                      <source src="<?= htmlspecialchars($video['fichier_url_video']) ?>" type="video/mp4">
                      Votre navigateur ne prend pas en charge la lecture vidéo.
                    </video>
                  </div>
                </div>

                <div class="right-part-video">
                  <h3>Description:</h3>
                  <p><?= htmlspecialchars($video['description_video']) ?></p>
                </div>
              </div>              
              <?php
              break;
      }
      ?>

      </div>
    </section>
  </div>
</body>
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header("Location: ../../pages/login.php");
    exit();
}

$page3 = $_GET['page3'] ?? ''; // page actuelle

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
          <li><a href="video-feedback.php?page3=video" class="<?= $page3 == 'video' ? 'active' : '' ?>">La Capsule Vidéo</a></li>
          <li><a href="video-feedback.php?page3=feedback" class="<?= $page3 == 'feedback' ? 'active' : '' ?>">Quizz</a></li>
        </ul>
      </div>

      <!-- Right part: Contenu -->
      <div class="right-part">

      <?php 
      switch ($page3) {
            case 'feedback':
              include 'feedback.php';
              break;
            case 'video.php':
            default:
              include 'video.php';
              break;
          }
      ?>

      </div>
    </section>
  </div>
</body>
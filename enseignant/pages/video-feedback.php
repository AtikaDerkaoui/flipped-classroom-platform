<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header("Location: ../../pages/login.php");
    exit();
}

$page2 = $_GET['page2'] ?? ''; // page actuelle

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
          <li><a href="video-feedback.php?page2=video" class="<?= $page2 == 'video' ? 'active' : '' ?>">Vidéos et feedback</a></li>
          <li><a href="video-feedback.php?page2=quizz" class="<?= $page2 == 'quizz' ? 'active' : '' ?>">Quizz</a></li>
        </ul>
      </div>

      <!-- Right part: Contenu -->
      <div class="right-part">

      <?php 
      switch ($page2) {
            case 'quizz':
              include 'quizz.php';
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
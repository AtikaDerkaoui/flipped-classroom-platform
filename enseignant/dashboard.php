<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header("Location: ../pages/login.php");
    exit();
}

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../includes/head.php');

$page = $_GET['page'] ?? ''; // page actuelle

?>


<body>
  <?php require_once(__DIR__.'/../includes/header-enseignant.php');
  ?>

  <div class="dashboard-container">
    <!-- ============= Navbar de bienvenu ============= -->
    <section class="bienvenu-navbar space-between">
        <h3 class="left-part">Bienvenue
          <?php
            echo $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ;  
          ?>
        </h3>
      
        <h3><a href="#" class="right-part">Guide d'utilisation</a></h3>
    </section>

    <!-- ============= Dashboard ============= -->
     <section class="dashboard space-between">
      <div class="left-part">
        <ul>
          <li><a href="dashboard.php?page=classes" class="<?= $page == 'classes' ? 'active' : '' ?>">Classes</a></li>
          <li><a href="dashboard.php?page=modules" class="<?= $page == 'modules' ? 'active' : '' ?>">Modules</a></li>
          <li><a href="dashboard.php?page=niveaux" class="<?= $page == 'niveaux' ? 'active' : '' ?>">Niveaux</a></li>
          <li><a href="dashboard.php?page=supports-pedagogiques" class="<?= $page == 'supports-pedagogiques' ? 'active' : '' ?>">Supports pédagogiques</a></li>
          <li><a href="dashboard.php?page=capsules" class="<?= $page == 'capsules' ? 'active' : '' ?>">Capsules vidéos</a></li>
          <li><a href="dashboard.php?page=quizz" class="<?= $page == 'quizz' ? 'active' : '' ?>">Quizz</a></li>
          <hr>
          <li><a href="dashboard.php?page=forum" class="<?= $page == 'forum' ? 'active' : '' ?>">Le forum</a></li>
          <hr>
          <li><a href="dashboard.php?page=guide" class="<?= $page == 'guide' ? 'active' : '' ?>">Guide d'utilisation</a></li>
          <li><a href="dashboard.php?page=faq" class="<?= $page == 'faq' ? 'active' : '' ?>">FAQ</a></li>
        </ul>
        
      </div>

      <div class="right-part">
        <?php 
          // Récupérer la page depuis l’URL
          $page = $_GET['page'] ?? 'accueil';

          // Inclure dynamiquement la bonne page
          switch ($page) {
    case 'classes':
        include('pages/classes.php');
        break;
    case 'modules':
        include('pages/accueil.php');
        break;
    case 'niveaux':
        include('pages/accueil.php');
        break;
    case 'supports-pedagogiques':
        include('pages/accueil.php');
        break;
    case 'capsules':
        include('pages/accueil.php');
        break;
    case 'quizz':
        include('pages/accueil.php');
        break;
    case 'forum':
        include('pages/accueil.php');
        break;
    case 'guide':
        include('pages/accueil.php');
        break;
    case 'faq':
        include('pages/accueil.php');
        break;
    case 'accueil':
    default:
        include('pages/accueil.php');
        break;
        }
        ?>
      </div>
     </section>
  </div>
</body>
</html>

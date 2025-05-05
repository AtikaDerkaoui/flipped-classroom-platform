<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
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
        <ul class="flex-centered">
          <li><a href="dashboard.php?page=classes">Classes</a></li>
          <li><a href="dashboard.php?page=eleves">Modules</a></li>
          <li><a href="dashboard.php?page=cours_ext">Niveaux</a></li>
          <li><a href="dashboard.php?page=cours_ext">Supports pédagogiques</a></li>
          <li><a href="dashboard.php?page=cours_ext">Capsules vidéos</a></li>
          <li><a href="dashboard.php?page=cours_ext">Quizz</a></li>
          <hr>
          <li><a href="dashboard.php?page=accueil">Le forum</a></li>
          <hr>
          <li><a href="dashboard.php?page=accueil">Guide d'utilisation</a></li>
          <li><a href="dashboard.php?page=accueil">FAQ</a></li>
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
    case 'eleves':
        include('pages/eleves.php');
        break;
    case 'cours':
        include('pages/cours_ext.php');
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

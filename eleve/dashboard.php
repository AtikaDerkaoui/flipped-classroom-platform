<?php
session_start();
require_once '../connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: ../pages/login.php");
    exit();
}

$page = $_GET['page'] ?? ''; // page actuelle

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>


<body>
    <?php require_once(__DIR__.'/../includes/header-member.php');
    ?>

    <div class="dashboard-container">
    <!-- ============= Navbar de bienvenu ============= -->
      <section class="bienvenu-navbar space-between">
        <h3 class="left-part">Bienvenue
          <?php
            echo $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ;  
          ?>
        </h3>
      
        <h3><a href="/Memoire/pages/ressources.php?page=guide" class="right-part">Guide d'utilisation</a></h3>
      </section>

      <!-- ============= Dashboard ============= -->
      <section class="dashboard space-between">
        <div class="left-part">
          <ul class="flex-centered">
            <li><a href="dashboard.php?page=classes" class="<?= $page == 'classes' ? 'active' : '' ?>">Toutes les classes</a></li>
            <li><a href="dashboard.php?page=classes-inscrites" class="<?= $page == 'classes-inscrites' ? 'active' : '' ?>">Mes classes</a></li>
            <li><a href="dashboard.php?page=cours_ext" class="<?= $page == 'cours_ext' ? 'active' : '' ?>">Cours extérieurs</a></li>

            <hr>
            <li><a href="dashboard.php?page=guide" class="<?= $page == 'guide' ? 'active' : '' ?>">Guide d'utilisation</a></li>
            <li><a href="dashboard.php?page=aide" class="<?= $page == 'aide' ? 'active' : '' ?>">Aide et conseils</a></li>
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
    case 'classes-inscrites':
        include('pages/classes-inscrites.php');
        break;
    case 'cours_ext':
        include('pages/cours-ext.php');
        break;
    case 'guide':
        include('pages/accueil.php');
        break;  
    case 'aide':
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

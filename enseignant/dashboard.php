<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>DzDucation - Bienvenue</title>
  <!-- Fichiers CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/styles/styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/header-styles.css">
  <link rel="stylesheet" type="text/css" href="../assets/styles/ens-styles.css">
  <!-- Animation JS -->
  <script type="text/javascript" src="../assets/scripts/scripts.js" defer></script>
  <!-- Les icônes fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css"/>
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

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
          <li><a href="dashboard.php?page=classes">Vos classes</a></li>
          <li><a href="dashboard.php?page=eleves">Elèves</a></li>
          <li><a href="dashboard.php?page=cours_ext">Cours extérieurs</a></li>
          <hr>
          <li><a href="dashboard.php?page=accueil">Le forum</a></li>
          <hr>
          <li><a href="dashboard.php?page=accueil">Guide d'utilisation</a></li>
          <li><a href="dashboard.php?page=accueil">FAQ</a></li>
        </ul>
        
      </div>

      <div class="right-part flex-centered">
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

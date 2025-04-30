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
  <div class="hero">
    <?php require_once(__DIR__.'/../includes/header-eleve.php');
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
            <li><a href="#">Vos classes</a></li>
            <li><a href="#">Elèves</a></li>
            <li><a href="#">Cours extérieurs</a></li>
            <hr>
            <li><a href="#">Le forum</a></li>
            <hr>
            <li><a href="#">Guide d'utilisation</a></li>
            <li><a href="#">Aide et conseils</a></li>
          </ul>
        </div>

        <div class="right-part flex-centered">
          <img src="../assets/img/pic-teacher.jpeg" alt="teacher-pic">
          <h4>Bienvenue sur votre espace enseignant !</h4>
          <p>Découvrez un outil conçu pour faciliter la mise en place 
          de la classe inversée. Accédez à des ressources, échangez 
          via le forum et le chat, et guidez vos élèves vers un 
          apprentissage actif et autonome. Ensemble, transformons 
          l'éducation !
          </p>
        </div>
      </section>
      
    </div>
  </div>
</body>
</html>

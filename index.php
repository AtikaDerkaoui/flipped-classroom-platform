<?php
  session_start();

  // Vérifier si l'utilisateur est déjà connecté
  if (isset($_SESSION['id'])) {
    // Si l'utilisateur est connecté, rediriger vers dashboard.php
    if ($_SESSION['role'] == 'enseignant') {
      header("Location: enseignant/dashboard.php");
      exit();  // Toujours appeler exit après header
    } elseif ($_SESSION['role'] == 'etudiant') {
      header("Location: eleve/dashboard.php");
      exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>DzDucation - Classe Inversée</title>
  <!-- Fichiers CSS -->
  <link rel="stylesheet" type="text/css" href="assets/styles/styles.css">
  <link rel="stylesheet" type="text/css" href="assets/styles/header-styles.css">
  <!-- Animation JS -->
  <script type="text/javascript" src="assets/scripts/scripts.js" defer></script>
  <!-- Les icônes fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css"/>
  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <!-- Favicon -->
  
</head>

<body>
  <div class="hero">
    <?php require_once(__DIR__.'/includes/header.php');
    ?>

    <section class="principal space-around">
      <div class="left-part flex-centered">
        <p>DzDucation : l'éducation repensée avec la classe inversée, 
        des cours interactifs, une communauté engagée, et des outils 
        pour apprendre, partager et échanger à votre rythme.
        </p>
      
        <a href="pages/register.php" class="btn">Commencez</a>
      </div>
    
      <div class="right-part flex-centered">
        <div class="img-container">
          <img src="assets/img/thumbs-up.png">
        </div>
      </div>

      <img src="/../Memoire/assets/img/wave.png" class="design-wave">
    </section> 
  </div>

</body>
</html>

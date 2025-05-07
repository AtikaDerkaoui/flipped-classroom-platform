<?php
  session_start();

  // Vérifier si l'utilisateur est déjà connecté
  if (isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, rediriger vers dashboard.php
    if ($_SESSION['role'] == 'enseignant') {
      header("Location: enseignant/dashboard.php");
      exit();  // Toujours appeler exit après header
    } elseif ($_SESSION['role'] == 'etudiant') {
      header("Location: eleve/dashboard.php");
      exit();
    }
  }
  // Le head
  $titre = "DzDucation - Accueil"; // titre de la page
  require_once(__DIR__.'/includes/head.php');
?>

<body>
    <!-- Le header -->
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

</body>
</html>

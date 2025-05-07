<?php
  session_start();

  // Vérifier si l'utilisateur est déjà connecté
  if (isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, rediriger vers dashboard.php
    if ($_SESSION['role'] == 'enseignant') {
      header("Location: ../enseignant/dashboard.php");
      exit();  // Toujours appeler exit après header
    } elseif ($_SESSION['role'] == 'etudiant') {
      header("Location: ../eleve/dashboard.php");
      exit();
    }
  }

  // Le head
  $titre = "DzDucation - Connectez vous"; // titre de la page
  require_once(__DIR__.'/../includes/head.php');
?>

<body>
    <!-- Le header -->
    <?php require_once(__DIR__.'/../includes/header.php');
    ?>

    <div class="register-container space-around ">
      <!-- Left part -->
      <div class="left-part flex-centered">
        <img src="../assets/img/inscription.jpg">
        <h2>Entrez dans le monde de la classe inversée, dés maintenant !</h2>
        <p>Créez un compte ou connectez vous pour commencer</p>
      </div>

      <!-- Right part -->
      <div class="right-part">
        <h2>Connectez vous</h2>
        <form action="../actions/loginAction.php" method="post" class="form">
          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Votre email" required>

          <label for="mot_de_passe">Mot de passe</label>
          <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>

          <?php
                // Vérifier s'il y a un message en session et l'afficher
                if (isset($_SESSION['message'])) {
                    echo "<p style='color:red;'>".$_SESSION['message']."</p>";
    
                    // Supprimer le message après l'affichage
                    unset($_SESSION['message']);
                }
            ?>
          <button type="submit" name="submit" class="btn">Se connecter</button>
        </form>
      </div>

    </div>
</body>
</html>
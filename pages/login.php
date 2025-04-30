<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>DzDucation - Classe Inversée</title>
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
  <!-- Favicon -->
  
</head>


<body>
  <div class="hero">
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
                session_start(); // Démarrer la session

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
  </div>
</body>
</html>
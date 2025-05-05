<?php
  session_start();

  // Vérifier si l'utilisateur est déjà connecté
  if (isset($_SESSION['id'])) {
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
  $titre = "DzDucation - Inscrivez vous"; // titre de la page
  require_once(__DIR__.'/../includes/head.php');
?>


<body>
    <?php require_once(__DIR__.'/../includes/header.php');
    ?>

    <div class="register-container space-around ">
        <div class="left-part flex-centered">
            <img src="../assets/img/inscription.jpg">
            <h2>Entrez dans le monde de la classe inversée, dés maintenant !</h2>
            <p>Créez un compte ou connectez vous pour commencer</p>
        </div>

        <div class="right-part">
            <?php
                // Vérifier s'il y a un message en session et l'afficher
                if (isset($_SESSION['message'])) {
                    echo "<p style='color:red;'>".$_SESSION['message']."</p>";
    
                    // Supprimer le message après l'affichage
                    unset($_SESSION['message']);
                }
            ?>
            
            <h2>Inscrivez vous</h2>
    
            <form action="../actions/registerAction.php" method="post" class="form">
                <div class="flex-row">
                    <div class="input-container">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="input-container">
                        <label for="prenom">Prenom</label>
                        <input type="text" name="prenom" placeholder="Prenom" required>
                    </div>
                </div>
                <label for="email">Votre email</label>
                <input type="email" name="email" placeholder="exemple@gmail.com" required>
        
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        
                <label for="role">Votre rôle</label>
                <select name="role" class="select-role" required>
                    <option value="enseignant">Je suis un enseignant</option>
                    <option value="eleve">Je suis un élève</option>
                </select>
        
                <button type="submit" name="submit" class="btn">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>

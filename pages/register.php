<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>DzDucation - Inscription</title>
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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- Favicon -->
</head>

<body>
    <div class="hero">
    <?php require_once(__DIR__.'/../includes/header.php');
    ?>

    <div class="register-container space-around ">
        <div class="left-part flex-centered">
            <img src="../assets/img/inscription.jpg">
            <h2>Entrez dans le monde de la classe inversée, dés maintenant !</h2>
            <p>Créez un compte ou connectez vous pour commencer</p>
        </div>

        <div class="right-part">
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
                    <option value="enseignant">Je suis un Enseignant</option>
                    <option value="eleve">Je suis un élève</option>
                </select>
        
                <button type="submit" name="submit" class="btn">S'inscrire</button>
            </form>
        </div>
    </div>
    </div>
    

</body>
</html>

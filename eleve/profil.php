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
    <?php require_once(__DIR__.'/../includes/header-enseignant.php');
    ?>

    <h1>Bienvenue, <?php echo $_SESSION['nom']; ?> !</h1>
    <p>Mon Profil.</p>
    <a href="../actions/logoutAction.php">Se déconnecter</a>
</body>
</html>

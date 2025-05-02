<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Le head
$titre = "DzDucation - Mon profil"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>


<body>
    <?php require_once(__DIR__.'/../includes/header-enseignant.php');
    ?>

    <h1>Bienvenue, <?php echo $_SESSION['nom']; ?> !</h1>
    <p>Mon Profil.</p>
    <a href="../actions/logoutAction.php">Se déconnecter</a>
</body>
</html>

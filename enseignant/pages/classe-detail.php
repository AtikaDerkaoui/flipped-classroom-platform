<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'enseignant') {
    header("Location: ../../pages/login.php");
    exit();
}

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');

// Inclure le fichier de connexion
require_once '../../connexion.php';

$id_classe = $_GET['id_classe'];
$sql = "SELECT classes.nom AS nom_classe, niveaux.nom AS nom_niveau, classes.module, utilisateurs.nom AS nom_enseignant, utilisateurs.prenom AS prenom_enseignant
        FROM classes
        JOIN niveaux ON classes.niveau_id = niveaux.id
        JOIN utilisateurs ON classes.enseignant_id = utilisateurs.id
        WHERE classes.id = :id_classe";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_classe', $id_classe);
$stmt->execute();
$classe = $stmt->fetch();
?>

<body>
  <?php // require_once(__DIR__.'/../includes/header-enseignant.php');
     require_once(__DIR__.'/../../includes/header-enseignant.php');
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
          <li><a href="#">Ma classe</a></li>
          <li><a href="#">Elèves</a></li>
          <li><a href="#">Supports pédagogiques</a></li>
          <li><a href="#">Vidéos et feedback</a></li>
          <li><a href="#">Quizz</a></li>
        </ul>
        
      </div>

      <div class="right-part">
      <form action="/Memoire/actions/deleteClass.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?');">
        <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
        <button type="submit" name="supprimer">Supprimer</button>
      </form>

      </div>
</section>
  </div>
</body>
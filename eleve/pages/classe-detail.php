<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: ../../pages/login.php");
    exit();
}

$page2 = $_GET['page2'] ?? ''; // page actuelle

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');

// Inclure le fichier de connexion
require_once '../../connexion.php';

$id_classe = $_GET['id_classe'];
$sql = "SELECT classes.nom_classe AS nom_classe, 
        departements.nom_departement AS nom_departement,
        niveaux.nom_niveau AS nom_niveau, classes.module, 
        utilisateurs.nom AS nom_enseignant, 
        utilisateurs.prenom AS prenom_enseignant
        FROM classes
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN departements ON classes.id_departement = departements.id_departement
        JOIN utilisateurs ON classes.id_enseignant = utilisateurs.id
        WHERE classes.id_classe = :id_classe";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_classe', $id_classe);
$stmt->execute();
$classe = $stmt->fetch();

$sql_supports = "SELECT * FROM supports WHERE id_classe = :id_classe";
$stmt_supports = $conn->prepare($sql_supports);
$stmt_supports->bindParam(':id_classe', $id_classe);
$stmt_supports->execute();
$supports = $stmt_supports->fetchAll();

?>

<body>
  <?php // require_once(__DIR__.'/../includes/header-enseignant.php');
     require_once(__DIR__.'/../../includes/header-enseignant.php');
  ?>

  <div class="dashboard-container">
    <!-- ============= Navbar de bienvenu ============= -->
    <section class="bienvenu-navbar space-between">
        <h3 class="left-part"><a href="javascript:history.back()"><- Retour</a></h3>
      
        <h3><a href="#" class="right-part">Guide d'utilisation</a></h3>
    </section>

    <!-- ============= Dashboard ============= -->
    <section class="dashboard space-between">
      <!-- Left part: Side Navbar -->
      <div class="left-part">
        <ul class="flex-centered">
          <li><a href="classe-detail.php?page2=ma-classe&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'ma-classe' ? 'active' : '' ?>">La classe</a></li>
          <li><a href="classe-detail.php?page2=supports&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'supports' ? 'active' : '' ?>">Supports pédagogiques</a></li>
          <li><a href="classe-detail.php?page2=videos&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'videos' ? 'active' : '' ?>">Vidéos et feedback</a></li>
          <li><a href="classe-detail.php?page2=quizz&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'quizz' ? 'active' : '' ?>">Quizz</a></li>

          <hr>
          <li><a href="dashboard.php?page=forum" class="<?= $page2 == 'forum' ? 'active' : '' ?>">Le forum</a></li>

          <hr>
          <li><a href="dashboard.php?page=guide" class="<?= $page2 == 'guide' ? 'active' : '' ?>">Guide d'utilisation</a></li>
          <li><a href="dashboard.php?page=aide" class="<?= $page2 == 'aide' ? 'active' : '' ?>">Aide et conseils</a></li>
        </ul>
      </div>

      <!-- Right part: Contenu -->
      <div class="right-part">
        <?php
          $page2 = $_GET['page2'] ?? 'ma-classe'; // ma_classe par défaut

          $id_classe = isset($_GET['id_classe']) ? (int)$_GET['id_classe'] : null;

          if (!$id_classe) {
              echo "<p>Erreur : identifiant de la classe manquant ou invalide.</p>";
              exit;
          }
          // Toujours charger les détails de la classe pour toutes les pages incluses
          $sql = "SELECT classes.nom_classe AS nom_classe, 
                  departements.nom_departement AS nom_departement,
                  niveaux.nom_niveau AS nom_niveau, classes.module, 
                  utilisateurs.nom AS nom_enseignant, 
                  utilisateurs.prenom AS prenom_enseignant
                  FROM classes
                  JOIN niveaux ON classes.id_niveau = niveaux.id_niveau 
                  JOIN departements ON classes.id_departement = departements.id_departement
                  JOIN utilisateurs ON classes.id_enseignant = utilisateurs.id
                  WHERE classes.id_classe = :id_classe";

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
          $stmt->execute();
          $classe = $stmt->fetch(PDO::FETCH_ASSOC);
          
          // Sécurité : si la classe n’existe pas
          if (!$classe) {
            echo "<p>Classe introuvable.</p>";
            exit;
          }
          // Afficher la page correspondante
          switch ($page2) {
            case 'supports':
              include 'supports.php';
              break;
            case 'videos':
              include 'ma-classe.php';
              break;
            case 'quizz':
              include 'ma-classe.php';
              break;
            case 'ma-classe':
            default:
              include 'ma-classe.php';
              break;
          }
        ?>
      </div>
    </section>
  </div>
</body>
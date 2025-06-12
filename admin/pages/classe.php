<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../pages/login.php");
    exit();
}

$page2 = $_GET['page2'] ?? ''; // page actuelle

// Le head
$titre = "DzDucation - Bienvenue"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');

// Inclure le fichier de connexion
require_once '../../connexion.php';

// recuperer la classe actuelle
$id_classe = $_GET['id_classe'];
$sql = "SELECT classes.nom_classe AS nom_classe, 
        departements.nom_departement AS nom_departement,
        niveaux.nom_niveau AS nom_niveau, 
        classes.module, 
        classes.code_classe,
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

// Récuperer la liste des supports de cette classe
$sql_supports = "SELECT * FROM supports WHERE id_classe = :id_classe";
$stmt_supports = $conn->prepare($sql_supports);
$stmt_supports->bindParam(':id_classe', $id_classe);
$stmt_supports->execute();
$supports = $stmt_supports->fetchAll();


// liste des vidéos
$sql_videos = "SELECT * FROM videos WHERE id_classe = :id_classe";
$stmt_videos = $conn->prepare($sql_videos); 
$stmt_videos->bindParam(':id_classe', $id_classe);
$stmt_videos->execute();
$videos = $stmt_videos->fetchAll();


// Récupérer le niveau et département actuels en cas de non modification de ceux ci
$stmt_classe = $conn->prepare("SELECT id_niveau, id_departement FROM classes WHERE id_classe = :id_classe");
$stmt_classe->bindParam(':id_classe', $id_classe);
$stmt_classe->execute();
$info = $stmt_classe->fetch(PDO::FETCH_ASSOC);
$id_niveau_actuel = $info['id_niveau'];
$id_departement_actuel = $info['id_departement'];


?>

<body>
  <?php
     require_once(__DIR__.'/../../includes/header-member.php');
  ?>

  <div class="dashboard-container">
    <!-- ============= Navbar de bienvenu ============= -->
    <section class="bienvenu-navbar space-between">
        <h3 class="left-part"><a href="javascript:history.back()">Retour</a></h3>
      
        <h3><a href="#" class="right-part">Guide d'utilisation</a></h3>
    </section>

    <!-- ============= Dashboard ============= -->
    <section class="dashboard space-between">
      <!-- Left part: Side Navbar -->
      <div class="left-part">
        <ul class="flex-centered">
          <li><a href="classe.php?page2=classe-details&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'classe-details' ? 'active' : '' ?>">La classe</a></li>
          <li><a href="classe.php?page2=eleves&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'eleves' ? 'active' : '' ?>">Elèves</a></li>
          <li><a href="classe.php?page2=supports&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'supports' ? 'active' : '' ?>">Supports pédagogiques</a></li>
          <li><a href="classe.php?page2=videos&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'videos' ? 'active' : '' ?>">Vidéos et feedback</a></li>
          <li><a href="classe.php?page2=quizz-standard&id_classe=<?= $id_classe ?>" class="<?= $page2 == 'quizz-standard' ? 'active' : '' ?>">Quizz</a></li>
        </ul>
      </div>

      <!-- Right part: Contenu -->
      <div class="right-part">
        <?php
          $page2 = $_GET['page2'] ?? 'classe-details'; // classe-details par défaut

          $id_classe = isset($_GET['id_classe']) ? (int)$_GET['id_classe'] : null;

          if (!$id_classe) {
              echo "<p>Erreur : identifiant de la classe manquant ou invalide.</p>";
              exit;
          }
          // Les détails de la classe
          $sql = "SELECT classes.nom_classe AS nom_classe, 
                  departements.nom_departement AS nom_departement,
                  niveaux.nom_niveau AS nom_niveau, 
                  classes.module, 
                  classes.code_classe,
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
            case 'eleves':
              include 'eleves.php';
              break;
            case 'supports':
              include 'supports.php';
              break;
            case 'videos':
              include 'videos.php';
              break;
            case 'quizz-standard':
              include 'quizz-standard.php';
              break;
            case 'classe-details':
            default:
              include 'classe-details.php';
              break;
          }
        ?>
      </div>
    </section>
  </div>
</body>
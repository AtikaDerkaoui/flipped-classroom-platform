<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$role = $_SESSION['role'];
$id_sub = $_GET['id_sub'];

require_once '../../connexion.php';

/* Récuperer la sous catégorie actuelle */
$sql = "SELECT sub_categories.titre_sub AS titre_sub
        FROM sub_categories
        WHERE sub_categories.id_sub = :id_sub";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_sub', $id_sub);
$stmt->execute();
$sub = $stmt->fetch();

// Récuperer la liste des sujets dans cette sous-categorie
$stmt_sujets = $conn->prepare("SELECT * FROM sujets WHERE id_sub = :id_sub");
$stmt_sujets->bindParam(':id_sub', $id_sub);
$stmt_sujets->execute();
$sujets = $stmt_sujets->fetchAll();

// Le head
$titre = "DzDucation - Sujets du Forum"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');
?>

<body>
<?php require_once(__DIR__.'/../../includes/header-forum.php');
?>

<div class="forum-container space-between">
  <div class="left-part">
    <a href="createSubject-page.php?id_sub=<?= $id_sub ?>" class="bouton-forum">Créer un nouveau sujet</a>
    <!-- liste des sujets -->
      <table class="forum-table" style="margin-top: 1rem;">
        <!-- Titre de la sous catégorie -->
        <thead>
          <tr>
            <th><h3><?= htmlspecialchars($sub['titre_sub']) ?></h3></th>
            <th><p>Réponses</p></th>
            <th>Dernière réponse</th>
          </tr>
        </thead>
        
        <!-- Liste des sujets -->
        <tbody>
          </tr>
          <?php foreach($sujets as $sujet): ?>
          <tr onclick="window.location.href='sujet.php?id_sujet=<?= $sujet['id_sujet'] ?>&id_sub=<?= $id_sub ?>';" style="cursor: pointer;">
            <td><p><?= htmlspecialchars($sujet['titre_sujet']) ?></p>
            <p>Créé le <?= htmlspecialchars($sujet['date_creation_sujet']) ?></p></td>
            <td>20</td>
            <td>08 juin 2025</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </div>

  <div class="right-part">

  </div>
</div>
</body>
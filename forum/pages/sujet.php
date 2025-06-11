<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$id_sub = $_GET['id_sub'];
$id_sujet = $_GET['id_sujet'];

require_once '../../connexion.php';

/* Récuperer la sous catégorie actuelle */
$sql = "SELECT sub_categories.titre_sub AS titre_sub
        FROM sub_categories
        WHERE sub_categories.id_sub = :id_sub";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_sub', $id_sub);
$stmt->execute();
$sub = $stmt->fetch();

/*$stmt = $conn->prepare("SELECT * FROM sujets WHERE id_sujet = :id_sujet");
$stmt->execute(['id_sujet' => $id_sujet]);
$sujet = $stmt->fetch();*/
$stmt = $conn->prepare("
    SELECT s.*, u.nom, u.prenom, u.role, d.nom_departement, n.nom_niveau
    FROM sujets s
    JOIN utilisateurs u ON s.id = u.id
    LEFT JOIN departements d ON u.id_departement = d.id_departement
    LEFT JOIN niveaux n ON u.id_niveau = n.id_niveau
    WHERE s.id_sujet = :id_sujet
");
$stmt->execute(['id_sujet' => $id_sujet]);
$sujet = $stmt->fetch();



/* Récuperer les réponses sur ce sujet */
$stmt_reponses = $conn->prepare("
    SELECT r.*, u.nom, u.prenom, d.nom_departement, n.nom_niveau, u.role 
    FROM reponses_sujets r
    JOIN utilisateurs u ON r.id = u.id
    LEFT JOIN departements d ON u.id_departement = d.id_departement
    LEFT JOIN niveaux n ON u.id_niveau = n.id_niveau
    WHERE r.id_sujet = :id_sujet
    ORDER BY r.date_creation_reponse_sujet ASC
");
$stmt_reponses->execute(['id_sujet' => $id_sujet]);
$reponses = $stmt_reponses->fetchAll();


// Le head
$titre = "DzDucation - Sujets du Forum"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');
?>

<body>
<?php require_once(__DIR__.'/../../includes/header-forum.php'); ?>

<div class="sujet-container">
    <div class="sujet-header">
      <h1><?= htmlspecialchars($sujet['titre_sujet']) ?></h1>
      <p class="sujet-date">Publié le : <?= htmlspecialchars($sujet['date_creation_sujet']) ?></p>
      <p class="sujet-date">Par : <?= htmlspecialchars($sujet['prenom'] . ' ' . $sujet['nom']) ?></p>
      <p class="sujet-date">Rôle : <?= htmlspecialchars($sujet['role']) ?></p>
      <?php if($sujet['role'] === 'eleve'): ?>
      <p class="sujet-date"><?= htmlspecialchars($sujet['nom_departement'] . ', ' . $sujet['nom_niveau']) ?></p>
      <?php endif; ?>
    </div>

    <div class="sujet-body">
      <?= nl2br(htmlspecialchars($sujet['contenu_sujet'])) ?>
    </div>

    <div class="reponse-section">
      <h2>Réponses</h2>
      <?php foreach ($reponses as $rep): ?>
        <div class="reponse-card">
          <!-- Informations sur l'utilisateur qui a répondu -->
          <div class="user-info">
            <p><strong><?= htmlspecialchars($rep['prenom'] . ' ' . $rep['nom']) ?></strong></p>
            <?php if($rep['role'] === 'eleve'): ?>
                <p>Département : <?= htmlspecialchars($rep['nom_departement']) ?></p>
                <p>Niveau : <?= htmlspecialchars($rep['nom_niveau']) ?></p>
            <?php endif; ?>
            <p>Rôle : <?= htmlspecialchars($rep['role']) ?></p>
          </div>

          <!-- Contenu de la réponse -->
          <div class="reponse-content">
            <p><?= nl2br(htmlspecialchars($rep['contenu_reponse_sujet'])) ?></p>
            <small>Répondu le : <?= $rep['date_creation_reponse_sujet'] ?></small>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="form-section">
      <h3>Ajouter une réponse</h3>
      <form action="/Memoire/actions/gestionForum.php" method="POST" class="form-reponse">
        <textarea name="contenu_reponse" required placeholder="Écrivez votre réponse ici..."></textarea>
        <input type="hidden" name="id_sujet" value="<?= $id_sujet ?>">
        <input type="hidden" name="id_sub" value="<?= $id_sub ?>">

        <button type="submit" name="ajouterReponse">Envoyer</button>
      </form>
    </div>
  </div>
</body>
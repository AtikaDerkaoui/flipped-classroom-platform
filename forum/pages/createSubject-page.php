<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$id_sub = $_GET['id_sub'];

require_once '../../connexion.php';

$sql = "SELECT sub_categories.titre_sub AS titre_sub
        FROM sub_categories
        WHERE sub_categories.id_sub = :id_sub";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_sub', $id_sub);
$stmt->execute();
$sub = $stmt->fetch();

// Le head
$titre = "DzDucation Forum - Créer un nouveau topic"; // titre de la page
require_once(__DIR__.'/../../includes/head.php');
?>


<body>
<?php require_once(__DIR__.'/../../includes/header-forum.php');
?>
<div class="forum-container">
<section class="forum-add-form">
    <form action="/Memoire/actions/gestionForum.php" method="POST" class="form">
        <h3>Ajouter un nouveau sujet dans <?= $sub['titre_sub'] ?></h3>
          <input type="hidden" name="id_sub" value="<?= $id_sub ?>">
          <input type="hidden" name="id" value="<?= $id ?>">

          <label for="titre_sujet">Titre du sujet</label>
          <input type="text" name="titre_sujet" placeholder="Titre du sujet" required>

          <label for="contenu_sujet">Contenu</label>
          <textarea name="contenu_sujet" rows="10" placeholder="Décrivez ici votre sujet en quelques lignes..."></textarea>

          <button type="submit" name="createTopic" class="bouton-standard">Ajouter</button>
    </form>
</section>
</div>
</body>
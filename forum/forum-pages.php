<?php
session_start();

$id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

require_once '../connexion.php';
// Récuperer la liste des catégories
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll();

$page = $_GET['page'];

// Le head
$titre = "DzDucation - Forum"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>

<body>
<?php require_once(__DIR__.'/../includes/header-forum.php');
?>

<div class="forum-container">
<?php if($page === 'createTopic'): ?>
    <form action="/Memoire/actions/gestionForum.php" method="POST">
        <input type="hidden" name="id_categorie" value="<?= $cat['id_categorie'] ?>">
        <input type="hidden" name="id" value="<?= $id ?>">

        <label for="titre_sujet">Titre du sujet</label>
        <input type="text" name="titre_sujet" placeholder="Titre du sujet" required>

        <label for="contenu_sujet">Contenu du sujet</label>
        <textarea name="contenu_sujet" rows="4" placeholder="Contenu du sujet"></textarea>

        <button type="submit" name="createTopic">Ajouter</button>
    </form>
<?php endif; ?>
</div>

</body>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$role = $_SESSION['role'];

require_once '../connexion.php';

// Récuperer la liste des catégories
$sql_categories = "SELECT * FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll();

// Le head
$titre = "DzDucation - Forum"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>

<body>
<?php require_once(__DIR__.'/../includes/header-forum.php');
?>

<div class="forum-container space-between">
  <div class="left-part">
<?php if($role === 'admin'): ?>
    <section class="create-category" style="display:none;">
      <h3><i class="fa-solid fa-folder-open"></i> Créer une nouvelle catégorie</h3>

      <form action="/Memoire/actions/gestionForum.php" method="POST" class="form">
        <label for="titre">Titre</label>
        <input type="text" name="titre" placeholder="Titre de la catégorie" required>

        <label for="description">Description</label>
        <textarea name="description" rows="2" placeholder="Ajouter la description de la catégorie ici..."></textarea>

        <button type="submit" name="createCategory" class="bouton-standard">Ajouter</button>
      </form>
    </section>
<?php endif; ?>

    <!-- Liste des catégories -->
    <?php foreach($categories as $cat): 
      $id_categorie = $cat['id_categorie'];
      // Récuperer la liste des sous-catégories
      $stmt_sub_categories = $conn->prepare("SELECT * FROM sub_categories WHERE id_categorie = :id_categorie");
      $stmt_sub_categories->bindParam(':id_categorie', $id_categorie);
      $stmt_sub_categories->execute();
      $sub_categories = $stmt_sub_categories->fetchAll();
    ?>
    <section class="categorie">
      <div class="category-header space-between">
        <h3><?= htmlspecialchars($cat['titre_categorie']) ?></h3>
        <?php if($role === 'admin'): ?>
        <p>Sous catégorie <button><i class="fa-solid fa-plus"></i></button></p>
        <?php endif; ?>
      </div>

      <div class="create-sub-category">
        <form action="/Memoire/actions/gestionForum.php" method="POST" class="form">
          <input type="hidden" name="id_categorie" value="<?= $cat['id_categorie'] ?>">

          <label for="titre">Titre</label>
          <input type="text" name="titre" placeholder="Titre de la sous catégorie" required>

          <label for="description">Description</label>
          <textarea name="description" rows="2" placeholder="Ajouter la description de la sous-catégorie ici..."></textarea>

          <button type="submit" name="createSubCategory" class="bouton-standard">Ajouter</button>
      </form>
      </div>

      <ul class="sub-categories">
        <?php foreach($sub_categories as $sub): ?>
          <li class="space-between">
            <h4><?= htmlspecialchars($sub['titre_sub']) ?></h4>
            <div>
              <p><?= htmlspecialchars($sub['description_sub']) ?></p>              
              <p>20 POSTS</p>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
    <?php endforeach; ?>
  </div>

  <div class="right-part">

  </div>
</div>
</body>
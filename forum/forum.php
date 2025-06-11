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
    <section class="create-category forum-form">
      <form action="/Memoire/actions/gestionForum.php" method="POST" class="form" >
        <h3>Créer une nouvelle catégorie</h3>

        <label for="titre">Titre</label>
        <input type="text" name="titre" placeholder="Titre de la catégorie" required>

        <label for="description">Description</label>
        <textarea name="description" rows="2" placeholder="Description de la catégorie"></textarea>

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
      <!-- créer une nouvelle sous catégorie -->
       <?php if($role === 'admin'): ?>
      <div class="create-sub-category">
        <p>Sous catégorie <button class="btn-neutre btn-icon btn-sous-categorie"><i class="fa-solid fa-plus"></i></button></p>

        <!-- formulaire pour créer une sous-catégorie -->
        <div class="forum-form">
          <form action="/Memoire/actions/gestionForum.php" method="POST" class="form">
          <input type="hidden" name="id_categorie" value="<?= $cat['id_categorie'] ?>">

          <label for="titre">Titre</label>
          <input type="text" name="titre" placeholder="Titre de la sous catégorie" required>

          <label for="description">Description</label>
          <textarea name="description" rows="2" placeholder="Ajouter la description de la sous-catégorie ici..."></textarea>

          <button type="submit" name="createSubCategory" class="bouton-standard">Ajouter</button>
          </form>
        </div>
      </div>
      <?php endif; ?>


      <table class="forum-table">
        <thead>
          <tr>
            <th><h3><?= htmlspecialchars($cat['titre_categorie']) ?></h3></th>
            <th><p>Sujets</p></th>
            <th>Dernier sujet</th>
          </tr>
        </thead>
        
        <tbody>
          </tr>
          <?php foreach($sub_categories as $sub): ?>
          <tr onclick="window.location.href='pages/sujets.php?id_sub=<?= $sub['id_sub'] ?>';" style="cursor: pointer;">
            <td>
              <p><?= htmlspecialchars($sub['titre_sub']) ?></p>
              <p><?= htmlspecialchars($sub['description_sub']) ?></p>
            </td>
            <td>20</td>
            <td>08 juin 2025</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endforeach; ?>
  </div>

  <div class="right-part">

  </div>
</div>
</body>

<script>
// Bouton pour afficher/fermer les résultats du quizz
// ***************************************************************
document.querySelectorAll(".btn-sous-categorie").forEach(function (button) {
    button.addEventListener("click", function () {
        const formContainer = button.closest(".create-sub-category"); // Trouve le conteneur du quiz
        const form = formContainer.querySelector(".forum-form"); // Trouve le formulaire dans ce quiz
        if (form) {
            form.classList.toggle("show"); // Affiche ou cache le formulaire
        }
    });
});
</script>
</script>
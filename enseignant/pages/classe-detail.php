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
$sql = "SELECT classes.nom_classe AS nom_classe, niveaux.nom_niveau AS nom_niveau, classes.module, utilisateurs.nom AS nom_enseignant, utilisateurs.prenom AS prenom_enseignant
        FROM classes
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN utilisateurs ON classes.id_enseignant = utilisateurs.id
        WHERE classes.id_classe = :id_classe";

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
        <!-- Supprimer une classe -->
        <form action="/Memoire/actions/deleteClass.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?');">
          <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
          <button type="submit" name="supprimer">Supprimer la classe</button>
        </form>
        <!-- Modifier une classe -->

        <!-- ========= Formulaire pour modifier une classe ========= --> 
        <div class="ajout-classe-form flex-centered" id="ajout-classe-form">
          <form action="../actions/createClass.php" method="post" class="form flex-centered">
          <!-- Header du formulaire -->
          <div class="header space-between">
            <div class="left-part">
              <img src="../assets/img/class-scene-black.svg">
              <h3>Ajouter une classe</h3>
            </div>
            <button type="button" onclick="afficherFormulaireClasse()" class="close-button"><i class="fa-solid fa-xmark"></i></button>
          </div>
          <!-- Le formulaire -->
          <div class="input-container">
            <label for="nom_classe">Nom de votre classe</label>
            <p>Ce nom est celui que vous et vos élèves verront</p>
            <input type="text" name="nom_classe" placeholder="Ex: Analyse mathématique - Section B " required>
    
            <label for="id_departement">Département</label>
            <p>Choisissez l'un de ces départements</p>
            <select name="id_departement" class="form-select" required>
            <?php 
              $departement = $conn->query("SELECT * FROM departements");

              foreach ($departement as $row) {
                echo "<option value='" . $row['id_departement'] . "'>" . $row['nom_departement'] . "</option>";
              }
            ?>
            </select>

            <label for="id_niveau">Niveau</label>
            <p>Choisissez le niveau enseigné dans cette classe</p>
            <select name="id_niveau" class="form-select" required>
            <?php 
              $niveau = $conn->query("SELECT * FROM niveaux");

              foreach ($niveau as $row) {
                echo "<option value='" . $row['id_niveau'] . "'>" . $row['nom_niveau'] . "</option>";
              }
            ?>
            </select>

            <label for="module">Matière (Ou contenu pédagogique)</label>
            <p>Ex: Mathématique ou Les verbes du 1er groupe</p>
            <input type="text" name="module" placeholder="Ex: Mathématique" required>

            <div class="btn-container">
              <button type="submit" name="submit">Ajouter la classe</button>
            </div>

    </div>
</form>
</div>
      </div>
</section>
  </div>
</body>
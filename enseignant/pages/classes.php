<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$enseignant_id = $_SESSION['user_id'];

$sql = "SELECT classes.nom AS nom_classe, classes.id AS id_classe,niveaux.nom AS nom_niveau, departements.nom_departement AS nom_departement, classes.module
        FROM classes
        JOIN niveaux ON classes.niveau_id = niveaux.id
        JOIN departements ON classes.id_departement = departements.id_departement
        WHERE classes.enseignant_id = :enseignant_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':enseignant_id', $enseignant_id);
$stmt->execute();
$classes = $stmt->fetchAll();
?>

<!-- ====================================================== --> 
<!-- ============= Liste des classes ajoutées ============= -->
<!-- ====================================================== --> 
<div class="classes">
<section class="ajout-classe space-between">
    <p style="font-weight: bold">Mes classes</p>
    <p>Ajouter une classe <button onclick="afficherFormulaireClasse()"><i class="fa-solid fa-plus"></i></button></p>
</section>


<section class="classes-container">
    <?php if (count($classes) > 0): ?>
        <?php foreach ($classes as $classe): ?>
            <div class="classe space-between" onclick="window.location.href='pages/classe-detail.php?id_classe=<?= $classe['id_classe'] ?>'" title="Consulter la classe">

                <div class="left-part flex-start">
                    <img src="../assets/img/class-scene-blue.png" alt="classe-pic">

                    <div class="right-part">
                        <h4><?= htmlspecialchars($classe['nom_classe']) ?></h4>
                        <div>
                            <h6><?= htmlspecialchars($classe['nom_niveau']) ?></h6>
                            <h6>Nombre d'élèves: ?</h6>
                        </div>
                    </div>
                </div>
                <div class="right-part">
                    <h6><?= htmlspecialchars($classe['module']) ?></h6>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune classe créée pour le moment.</p>
    <?php endif; ?>


<!-- ========= Formulaire pour ajouter une classe ========= --> 
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
        <label for="">Nom de votre classe</label>
        <p>Ce nom est celui que vous et vos élèves verront</p>
        <input type="text" name="nom" placeholder="Ex: Analyse mathématique - Section B " required>
    
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

        <label for="niveau_id">Niveau:</label>
        <p>Choisissez le niveau enseigné dans cette classe</p>
        <select name="niveau_id" class="form-select" required>
        <?php 
            $niveau = $conn->query("SELECT * FROM niveaux");

            foreach ($niveau as $row) {
                echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
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
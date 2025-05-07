<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$enseignant_id = $_SESSION['user_id'];

$sql = "SELECT classes.nom AS nom_classe, niveaux.nom AS nom_niveau, classes.module
        FROM classes
        JOIN niveaux ON classes.niveau_id = niveaux.id
        WHERE classes.enseignant_id = :enseignant_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':enseignant_id', $enseignant_id);
$stmt->execute();
$classes = $stmt->fetchAll();
?>

<div class="classes">
<!-- Ajouter une classe -->
<section class="ajout-classe space-between">
    <p>Mes classes</p>
    <p>Ajouter une classe <button onclick="afficherFormulaireClasse()"><i class="fa-solid fa-plus"></i></button></p>
</section>

<section class="classes-container">
    <?php if (count($classes) > 0): ?>
        <?php foreach ($classes as $classe): ?>
            
            <div class="classe space-between">
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
                    <a href="#"><h4>Consulter >></h4></a>
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
        <label for="">Titre de classe:</label>
        <p>Ce titre est celui que vos élèves verront</p>
        <input type="text" name="nom" placeholder="Ex: Analyse mathématique - Section B " required>
    
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
<?php
// Inclure le fichier de connexion
require_once '../connexion.php';
?>

<div class="classes">
<!-- Ajouter une classe -->
<section class="ajout-classe space-between">
    <p>Mes classes</p>
    <p>Ajouter une classe <button onclick="afficherFormulaireClasse()"><i class="fa-solid fa-plus"></i></button></p>
</section>

<!-- Les classes -->
<section class="classes-container">
    <div class="classe space-between">
        <!-- Partie gauche de la classe classe -->
        <div class="left-part flex-start">
            <img src="../assets/img/class-scene-blue.png" alt="classe-pic">
            <!-- Partie gauche de left-part -->
            <div class="right-part">
                <h4>Mr Hamadi classe 1as3</h4>
                <div>
                    <h6>1ère année secondaire</h6>
                    <h6>20 élèves</h6>
                </div>
            </div>
        </div>
        <!-- Partie droite de la classe -->
        <div class="right-part">
            <h6>Français</h6>
            <a href="#"><h4>Consulter >></h4></a>
        </div>
    </div>

    <div class="classe space-between">
        <!-- Partie gauche de la classe classe -->
        <div class="left-part flex-start">
            <img src="../assets/img/class-scene-blue.png" alt="classe-pic">
            <!-- Partie gauche de left-part -->
            <div class="right-part">
                <h4>Mme Derkaoui 3am2</h4>
                <div>
                    <h6>3ème année moyenne</h6>
                    <h6>30 élèves</h6>
                </div>
            </div>
        </div>
        <!-- Partie droite de la classe -->
        <div class="right-part">
            <h6>Verbes irrégulier</h6>
            <a href="#"><h4>Consulter >></h4></a>
        </div>
    </div>
</section>
</div>


<div class="ajout-classe-form flex-centered" id="ajout-classe-form">
<form action="../actions/createClass.php" method="post">
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
        <input type="text" name="nom" placeholder="Ex: Mme Derkaoui classe 2as" required>
    </div>

    <div class="input-container">
        <label for="niveau_id">Niveau:</label>
        <p>Choisissez le niveau enseigné dans cette classe</p>
        <select name="niveau_id" required>
    <?php 
        $niveau = $conn->query("SELECT * FROM niveaux");

        foreach ($niveau as $row) {
            echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
        }
    ?>
        </select>
    </div>

    <div class="input-container">
        <label for="">Matière (Ou contenu pédagogique)</label>
        <p>Ex: Mathématique ou Les verbes du 1er groupe</p>
        <input type="text" name="module" placeholder="Ex: Mathématique" required>
    </div>

    <button type="submit" name="submit">Créer la classe</button>

</form>
</div>
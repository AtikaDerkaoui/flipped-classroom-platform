<?php
// Inclure le fichier de connexion
require_once '../connexion.php';
?>

<h1>CLASSES</h1>
<form action="../actions/createClass.php" method="post">
    <label for="">Titre de classe:</label>
    <input type="text" name="nom" placeholder="Nom" required>

    <label for="niveau_id">Niveau:</label>
    <select name="niveau_id" required>
    <?php 
        $niveau = $conn->query("SELECT * FROM niveaux");

        foreach ($niveau as $row) {
            echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
        }
    ?>
    </select>

    <label for="">Matière:</label>
    <input type="text" name="module" placeholder="module" required>

    <button type="submit" name="submit">Créer la classe</button>
</form>
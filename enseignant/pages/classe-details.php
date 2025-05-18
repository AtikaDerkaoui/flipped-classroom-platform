<!-- Supprimer la classe -->
<form action="/Memoire/actions/deleteClass.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?');">
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <button type="submit" name="supprimer">Supprimer la classe</button>
</form>

<!-- Modifier la classe -->
<p><button id="btn-modifier-classe">Modifier la classe</button></p>
<!-- Appel au formulaire de modification de la classe -->
<?php
    require_once(__DIR__.'/../../includes/modifyClass-form.php');
?>

<p><strong>Nom de la classe: </strong><?= htmlspecialchars($classe['nom_classe']) ?></p>
<p><strong>Département: </strong><?= htmlspecialchars($classe['nom_departement']) ?></p>
<p><strong>Niveau enseigné: </strong><?= htmlspecialchars($classe['nom_niveau']) ?></p>
<p><strong>Matière (Ou contenu pédagogique): </strong><?= htmlspecialchars($classe['module']) ?></p>
<?php 
    if ($_SESSION['role'] === 'enseignant') {
        echo "<p><strong>Code de la classe: </strong>" . htmlspecialchars($classe['code_classe']) . "</p>";
    }
?>
<p><strong>Enseignant: </strong><?= htmlspecialchars($classe['nom_enseignant'])?> <?=htmlspecialchars($classe['prenom_enseignant']) ?></p>
        
<p><strong>Nombre d'élèves inscrits dans la classe: ??</strong></p>


<!-- =========== JAVASCRIPT =========== -->
<script>
// Bouton pour afficher le formulaire de modification d'une classe
// =============================================================
document.getElementById("btn-modifier-classe").addEventListener("click", function () {
    document.getElementById("modifier-classe-form").classList.toggle('show');
});

// Bouton pour fermer le formulaire de modification d'une classe
// =============================================================
document.getElementById("btn-fermer-classe").addEventListener("click", function () {
    document.getElementById("modifier-classe-form").classList.remove('show');
});
</script>
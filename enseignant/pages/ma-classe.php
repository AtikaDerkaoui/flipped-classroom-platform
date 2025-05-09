<!-- Supprimer la classe -->
<form action="/Memoire/actions/deleteClass.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?');">
    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
    <button type="submit" name="supprimer">Supprimer la classe</button>
</form>

<!-- Modifier la classe -->
<p><button onclick="afficherFormulaireClasse()">Modifier la classe</button></p>
<?php
        require_once(__DIR__.'/../../includes/modifyClass-form.php');
    ?>

    <p><strong>Nom de la classe: </strong><?= htmlspecialchars($classe['nom_classe']) ?></p>
    <p><strong>Département: </strong><?= htmlspecialchars($classe['nom_departement']) ?></p>
    <p><strong>Niveau enseigné: </strong><?= htmlspecialchars($classe['nom_niveau']) ?></p>
    <p><strong>Matière (Ou contenu pédagogique): </strong><?= htmlspecialchars($classe['module']) ?></p>
    <p><strong>Enseignant: </strong><?= htmlspecialchars($classe['nom_enseignant'])?> <?=htmlspecialchars($classe['prenom_enseignant']) ?></p>
        
    <p><strong>Nombre d'élèves inscrits dans la classe: ??</strong></p>
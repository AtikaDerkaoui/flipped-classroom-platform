<h1>La classe</h1>
<p><strong>Nom de la classe: </strong><?= htmlspecialchars($classe['nom_classe']) ?></p>
<p><strong>Département: </strong><?= htmlspecialchars($classe['nom_departement']) ?></p>
<p><strong>Niveau enseigné: </strong><?= htmlspecialchars($classe['nom_niveau']) ?></p>
<p><strong>Matière (Ou contenu pédagogique): </strong><?= htmlspecialchars($classe['module']) ?></p>
<p><strong>Enseignant: </strong><?= htmlspecialchars($classe['nom_enseignant'])?> <?=htmlspecialchars($classe['prenom_enseignant']) ?></p>
        
<p><strong>Nombre d'élèves inscrits dans la classe: ??</strong></p>

<!-- Formulaire pour s'inscrire à la classe -->
<?php
    require_once(__DIR__.'/../../includes/inscriptionClass-form.php');
?>
<div class="classe-details">

<div class="header-standard space-between">
    <!-- Supprimer la classe -->
    <form action="/Memoire/actions/deleteClass.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette classe ?');">
        <input type="hidden" name="id_classe" value="<?= $id_classe ?>">
        <button type="submit" name="supprimer" class="bouton-standard btn-blue"><i class="fa-solid fa-trash"></i> Supprimer la classe</button>
    </form>
</div>

<!-- Appel au formulaire de modification de la classe -->
<?php
    require_once(__DIR__.'/../../includes/modifyClass-form.php');
?>

<h1>Détails de la classe</h1>
<div class="classe-card">
<!--Nom de la classe -->
<p><strong>Nom de la classe: </strong><?= htmlspecialchars($classe['nom_classe']) ?></p>
<!-- Département de la classe -->
<p><strong>Département: </strong><?= htmlspecialchars($classe['nom_departement']) ?></p>
<!-- Niveau enseigné -->
<p><strong>Niveau enseigné: </strong><?= htmlspecialchars($classe['nom_niveau']) ?></p>
<!-- Matière enseignée danss la classe -->
<p><strong>Matière (Ou contenu pédagogique): </strong><?= htmlspecialchars($classe['module']) ?></p>
<!-- Code de la classe (si role de l'utilisateur est enseignant) -->
<?php 
    if ($_SESSION['role'] === 'enseignant' || $_SESSION['role'] === 'admin') {
        echo "<p><strong>Code de la classe: </strong>" . htmlspecialchars($classe['code_classe']) . "</p>";
    }
?>
<!-- Nom et prénom de l'enseignant de la classe -->
<p><strong>Enseignant: </strong><?= htmlspecialchars($classe['nom_enseignant'])?> <?=htmlspecialchars($classe['prenom_enseignant']) ?></p>
        
<!-- Nombre d'élèves inscrits dans la classe -->
<?php
$sql = "SELECT COUNT(*) AS nb_eleves FROM inscriptions WHERE id_classe = :id_classe";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<p><strong>Nombre d'élèves inscrits : </strong>" . $result['nb_eleves'] ."</p>";
?>

</div>
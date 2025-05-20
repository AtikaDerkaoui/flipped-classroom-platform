<?php 
require_once '../connexion.php';

$id_eleve = $_SESSION['user_id'];

$sql = "SELECT inscriptions.id_classe as id_classe,
        classes.nom_classe as nom_classe,
        departements.nom_departement AS nom_departement, 
        niveaux.nom_niveau AS nom_niveau, 
        classes.module 
        FROM inscriptions 
        JOIN classes ON inscriptions.id_classe = classes.id_classe
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN departements ON classes.id_departement = departements.id_departement
        WHERE inscriptions.id = :id_eleve"; // id = :id_eleve

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_eleve', $id_eleve);
$stmt->execute();
$inscriptions = $stmt->fetchAll();
?>


<div class="classes">
<section class="ajout-classe space-between">
    <p style="font-weight: bold">Mes classes</p>
</section>

<section class="classes-container">
<?php count($inscriptions) ?>
<?php if (count($inscriptions) > 0): ?>
    <?php foreach ($inscriptions as $inscription): ?>
        <div class="classe space-between" onclick="window.location.href='pages/classe.php?page2=classe-details&id_classe=<?= $inscription['id_classe'] ?>'" title="Consulter la classe">
            <div class="left-part flex-start">
                <img src="../assets/img/class-scene-blue.png" alt="classe-pic">

                <div class="right-part">
                    <h4><?= htmlspecialchars($inscription['nom_classe']) ?></h4>
                    <div><h6><?= htmlspecialchars($inscription['nom_niveau']) ?></h6></div>
                </div>
            </div>
            <div class="right-part space-between">
                <h4><?= htmlspecialchars($inscription['nom_departement']) ?></h4>
                <h6><?= htmlspecialchars($inscription['module']) ?></h6>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <h1>Vous n'êtes inscrit(e) à aucune classe.</h1>
<?php endif; ?>
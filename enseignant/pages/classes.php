<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$id_enseignant = $_SESSION['user_id'];

$sql = "SELECT classes.nom_classe AS nom_classe, 
        classes.id_classe AS id_classe, 
        departements.nom_departement AS nom_departement, 
        niveaux.nom_niveau AS nom_niveau, 
        classes.module
        FROM classes
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN departements ON classes.id_departement = departements.id_departement
        WHERE classes.id_enseignant = :id_enseignant";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_enseignant', $id_enseignant);
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
    <?php count($classes) ?>
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
                <div class="right-part space-between">
                    <h4><?= htmlspecialchars($classe['nom_departement']) ?></h4>
                    <h6><?= htmlspecialchars($classe['module']) ?></h6>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune classe créée pour le moment.</p>
    <?php endif; ?>



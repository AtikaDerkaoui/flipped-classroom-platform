<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$niveau_eleve = $_SESSION['id_niveau'];
$departement_eleve = $_SESSION['id_departement'];


$sql = "SELECT classes.nom_classe AS nom_classe, 
        classes.id_classe AS id_classe, 
        departements.nom_departement AS nom_departement, 
        niveaux.nom_niveau AS nom_niveau, 
        classes.module 
        FROM classes 
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN departements ON classes.id_departement = departements.id_departement
        WHERE classes.id_niveau = :niveau_eleve
        AND classes.id_departement = :departement_eleve";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':niveau_eleve', $niveau_eleve);
$stmt->bindParam(':departement_eleve', $departement_eleve);
$stmt->execute();
$classes = $stmt->fetchAll();

?>

<!-- ====================================================== --> 
<!-- ============= Liste des classes ajoutées ============= -->
<!-- ====================================================== --> 
<div class="classes">
    <section class="ajout-classe space-between">
        <p style="font-weight: bold">Toutes les classes</p>
    </section>

    <section class="classes-container">
    <!-- ======= Affichage des classes disponible ======= -->
    <?php count($classes) ?>
    <?php if (count($classes) > 0): ?>
        
        <?php foreach ($classes as $classe): ?>
            <div class="classe space-between" onclick="window.location.href='pages/classe.php?page2=classe-details&id_classe=<?= $classe['id_classe'] ?>'" title="Consulter la classe">

                <div class="left-part flex-start">
                    <img src="../assets/img/class-scene-blue.png" alt="classe-pic">

                    <div class="right-part">
                        <h4><?= htmlspecialchars($classe['nom_classe']) ?></h4>
                        <div>
                            <h6><?= htmlspecialchars($classe['nom_niveau']) ?></h6>
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
    </section>
</div>
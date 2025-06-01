<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$id_admin = $_SESSION['user_id'];

$sql = "SELECT classes.nom_classe AS nom_classe, 
        classes.id_classe AS id_classe, 
        departements.nom_departement AS nom_departement, 
        niveaux.nom_niveau AS nom_niveau, 
        classes.module
        FROM classes
        JOIN niveaux ON classes.id_niveau = niveaux.id_niveau
        JOIN departements ON classes.id_departement = departements.id_departement";

$stmt = $conn->prepare($sql);
$stmt->execute();
$classes = $stmt->fetchAll();
?>

<!-- ====================================================== --> 
<!-- ============= Liste des classes ajoutées ============= -->
<!-- ====================================================== --> 
<div class="classes">
<section class="ajout-classe space-between">
    <h2>Classes</h2>
</section>

<?php
if (isset($_SESSION['erreur_code'])) {
    echo "<script>alert('{$_SESSION['erreur_code']}');</script>";
    unset($_SESSION['erreur_code']); // Supprimer le message après l'affichage
}
?>
<section class="classes-container">
    <!-- ======= Affichage des classes créées ======= -->
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


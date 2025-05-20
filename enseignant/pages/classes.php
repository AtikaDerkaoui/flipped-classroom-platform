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
    <p>Ajouter une classe <button id="btn-ajout-classe"><i class="fa-solid fa-plus"></i></button></p>
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

    <!-- ======= Formulaire pour créer une classe ======= -->
    <?php
        require_once(__DIR__.'/../../includes/createClass-form.php');
    ?>
</section>

<script>
// ============================================================
// Bouton pour afficher le formulaire de création d'une classe
// ============================================================
document.getElementById("btn-ajout-classe").addEventListener("click", function () {
    console.log("hello ajout");
    document.getElementById("ajout-classe-form").classList.toggle('show');
});


// =========================================================
// Bouton pour fermer le formulaire de création d'une classe
// =========================================================
document.getElementById("btn-fermer-ajout-classe").addEventListener("click", function () {
    document.getElementById("ajout-classe-form").classList.toggle('show');
});
</script>
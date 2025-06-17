<div class="supports">
<p>Ces cours seront disponibles pour tous les utilisateurs connectés à la plateforme.</p>
<h1>Ajouter un cours</h1>
<div class="form-container">
<!-- Formulaire pour ajouter un nouveau cours -->
<form action="/Memoire/actions/gestionCoursExt.php" method="post" enctype="multipart/form-data" class="space-between form">
    <label for="titre_cours">Titre du cours : </label>
    <input type="text" name="titre_cours" placeholder="Ex: Les systèmes distribués - Explication" required>

    <label for="fichier_url_cours">Fichier :</label>
    <input type="file" name="fichier_url_cours" id="fichier_url_cours" class="custom-file-input" required>

    <input type="hidden" name="id" value="<?= $_SESSION['user_id'] ?>">

    <button type="submit" name="addCoursExt">Ajouter le cours</button>
</form>
</div>

<?php 
// Récuperer la liste des cours extérieurs
$sql_cours = "SELECT c.id_cours, c.titre_cours, c.fichier_url_cours, c.type_cours, c.date_ajout_cours, u.nom, u.prenom
              FROM cours_ext c
              JOIN utilisateurs u ON c.id = u.id";
$stmt_cours = $conn->prepare($sql_cours);
$stmt_cours->execute();
$cours = $stmt_cours->fetchAll();
?>

<div class="liste-supports">
<h2>Liste des cours disponibles</h2>
<?php if (count($cours) > 0): ?>
    <table class="modern-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Téléchargement</th>
                <th>Ajouté par</th>
                <th>Date d'ajout</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cours as $cour):  ?>
                <tr>
                    <td><?= htmlspecialchars($cour['titre_cours']) ?></td>
                    <td><?= htmlspecialchars($cour['type_cours']) ?></td>
                    <td>
                        <a href="<?= htmlspecialchars($cour['fichier_url_cours']) ?>" download>
                            <button>Télécharger</button>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($cour['nom']) . ' ' . htmlspecialchars($cour['prenom']) ?></td>
                    <td>
                        <?php
                        $date = new DateTime($cour['date_ajout_cours']);
                        echo $date->format('d/m/Y'); ?>
                    </td>
                    <td>
                        <form action="/Memoire/actions/gestionCoursExt.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce cours ?');">
                            <input type="hidden" name="id_cours" value="<?= $cour['id_cours'] ?>">

                            <button type="submit" name="deleteCoursExt">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun cours disponible.</p>
<?php endif; ?>
</div>
</div>
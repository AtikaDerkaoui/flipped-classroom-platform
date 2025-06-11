<?php 
$id_eleve = $_SESSION['user_id'];

if ($classe) {
    $id_classe = $classe['id_classe'];

    // Vérifier que l'élève est pas inscrit à la classe
    $verif = $conn->prepare("SELECT * FROM inscriptions WHERE id = :id_eleve AND id_classe = :id_classe");
    $verif->bindParam(':id_eleve', $id_eleve);
    $verif->bindParam(':id_classe', $id_classe);
    $verif->execute();
?>

<?php if ($verif->rowCount() !== 0): ?>

<div class="supports">
<div class="liste-supports">
<h3>Liste des supports</h3>
<?php if (count($supports) > 0): ?>
    <table class="modern-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Téléchargement</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supports as $support): ?>
                <tr>
                    <td><?= htmlspecialchars($support['titre_support']) ?></td>
                    <td><?= htmlspecialchars($support['type_support']) ?></td>
                    <td>
                        <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>
                            <button>Télécharger</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="negatif-msg">Aucun support pédagogique ajouté pour cette classe.</p>
<?php endif; ?>
</div>
</div>

<?php else: ?>
    <p class="negatif-msg">Vous devez vous inscrire pour accéder au contenu de cette classe.</p>
<?php endif; ?>
<?php }?>


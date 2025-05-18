<h1>Supports</h1>

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
        <?php if (count($supports) > 0): ?>
            <ul>
                <?php foreach ($supports as $support): ?>
                <li>
                    <strong><?= htmlspecialchars($support['titre_support']) ?></strong> <br>
                    Type : <?= htmlspecialchars($support['type_support']) ?> <br>
                    <?php if ($support['type_support'] === 'pdf'): ?>
                        <iframe src="<?= htmlspecialchars($support['fichier_url_support']) ?>" width="100%" height="400px"></iframe>
                    <?php elseif ($support['type_support'] === 'image'): ?>
                        <img src="<?= htmlspecialchars($support['fichier_url_support']) ?>" alt="Support image" style="max-width: 300px;">
                    <?php elseif ($support['type_support'] === 'doc'): ?>
                        <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>Télécharger le document Word</a>
                    <?php else: ?>
                        <a href="<?= htmlspecialchars($support['fichier_url_support']) ?>" download>Télécharger le fichier</a>
                    <?php endif; ?>
                </li>
                <hr><br>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun support pédagogique ajouté pour cette classe.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Vous devez vous inscrire pour accéder aux contenu de cette classe.</p>
    <?php endif; ?>
<?php }?>


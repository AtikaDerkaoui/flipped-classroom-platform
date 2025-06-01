<?php
$sql_inscriptions = "SELECT * FROM inscriptions WHERE id_classe = :id_classe";
$stmt_inscriptions = $conn->prepare($sql_inscriptions);
$stmt_inscriptions->bindParam(':id_classe', $id_classe);
$stmt_inscriptions->execute();
$inscriptions = $stmt_inscriptions->fetchAll();
?>

<?php
$sql = "SELECT u.nom, u.prenom, u.id AS id_eleve
        FROM inscriptions i
        JOIN utilisateurs u ON i.id = u.id
        WHERE i.id_classe = :id_classe";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_classe', $id_classe);
$stmt->execute();
$eleves = $stmt->fetchAll();
?>


<!-- 
<?php // if (count($inscriptions) > 0): ?>
    <ul>
    <?php // foreach ($inscriptions as $inscription): ?>
        <li>
            <strong>Id d'élève: // htmlspecialchars($inscription['id'])</strong> <br>
        </li>
        
        <hr><br>
    <?php //endforeach; ?>
    </ul>
<?php // else: ?>
    <p>Aucun élève inscrit dans cette classe.</p>
<?php // endif; ?>
-->

<?php if (count($eleves) > 0): ?>
    <ul>
    <?php foreach ($eleves as $eleve): ?>
        <li>
            <strong><?= htmlspecialchars($eleve['nom']) ?> <?= htmlspecialchars($eleve['prenom']) ?></strong>
            (ID : <?= htmlspecialchars($eleve['id_eleve']) ?>)
        </li>
        <hr>
    <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun élève inscrit dans cette classe.</p>
<?php endif; ?>
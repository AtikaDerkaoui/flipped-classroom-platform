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


<div class="eleves">
<h2>Listes des élèves inscrits dans cette classe</h2>
<?php if (count($eleves) > 0): ?>
    <table class="modern-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Supprimer de la classe</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eleves as $eleve): ?>
                <tr>
                    <td><?= htmlspecialchars($eleve['id_eleve']) ?></td>
                    <td><?= htmlspecialchars($eleve['nom']) ?></td>
                    <td><?= htmlspecialchars($eleve['prenom']) ?></td>
                    <td>
                        <form action="/Memoire/actions/gestionClasse.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce support ?');">
                            <input type="hidden" name="id_support" value="<?= $support['id_support'] ?>">
                            <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

                            <button type="submit" name="deleteInscription">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>Aucun élève inscrit dans cette classe.</p>
<?php endif; ?>
</div>
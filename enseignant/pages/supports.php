<div class="supports">
<h1>Ajouter un support pédagogique</h1>
<!-- Formulaire pour ajouter un nouveau support -->
<form action="/Memoire/actions/addSupport.php" method="post" enctype="multipart/form-data" class="space-between form">
    <label for="titre_support">Titre de support pédagogique: </label>
    <input type="text" name="titre_support" placeholder="Ex: Les systèmes distribués - Explication" required>

    <label for="fichier_url_support">Fichier :</label>
    <input type="file" name="fichier_url_support" id="fichier_url_support" class="custom-file-input" required>

    <input type="hidden" name="id_classe" value="<?= $id_classe ?>">

    <button type="submit">Ajouter le support</button>
</form>

<div class="liste-supports">
<h2>Liste des supports</h2>
<?php if (count($supports) > 0): ?>
    <table class="modern-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Téléchargement</th>
                <th>Supprimer</th>
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
                    <td>
                        <button>Supprimer</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun support pédagogique ajouté pour cette classe.</p>
<?php endif; ?>
</div>
</div>
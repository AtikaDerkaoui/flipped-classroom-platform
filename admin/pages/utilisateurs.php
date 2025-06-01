<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

$id_admin = $_SESSION['user_id'];

$sql = "SELECT utilisateurs.id AS id, 
        utilisateurs.nom as nom,
        utilisateurs.prenom as prenom,
        utilisateurs.email as email,
        utilisateurs.role as user_role,
        utilisateurs.date_inscription as date_inscription,
        departements.nom_departement AS nom_departement, 
        niveaux.nom_niveau AS nom_niveau
        FROM utilisateurs
        LEFT JOIN niveaux ON utilisateurs.id_niveau = niveaux.id_niveau
        LEFT JOIN departements ON utilisateurs.id_departement = departements.id_departement";

$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();
?>


<div class="classes">
    <section class="ajout-classe space-between">
        <h2>Utilisateurs</h2>
    </section>

    <section class="liste-utilisateurs">
    <table border="1" cellpadding="10" cellspacing="0">

    <thead>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Email</th>
      <th>Rôle</th>
      <th>Date d'inscription</th>
      <th>ID Niveau</th>
      <th>ID Département</th>
      <th>Supprimer</th>
    </tr>
    </thead>

    <tbody>
    <?php count($users) ?>
    <?php if (count($users) > 0): ?>
        <?php foreach ($users as $user): ?>
            <tr>
      <td><?= htmlspecialchars($user['id']) ?></td>
      <td><?= htmlspecialchars($user['nom']) ?></td>
      <td><?= htmlspecialchars($user['prenom']) ?></td>
      <td><?= htmlspecialchars($user['email']) ?></td>
      <td><?= htmlspecialchars($user['user_role']) ?></td>
      <td><?= htmlspecialchars($user['date_inscription']) ?></td>
      <td><?= htmlspecialchars($user['nom_niveau']) ?></td>
      <td><?= htmlspecialchars($user['nom_departement']) ?></td>
      <td>
        <form action="supprimer_utilisateur.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
          <input type="hidden" name="id" value="1">
          <button type="submit">Supprimer</button>
        </form>
      </td>
    </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun utilisateur inscrit dans la plateforme pour le moment.</p>
    <?php endif; ?>
        </section>

</div>
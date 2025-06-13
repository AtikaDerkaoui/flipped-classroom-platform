<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../pages/login.php");
    exit();
}

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

<div class="utilisateurs">
  <div class="header-standard">
    <h2>Gestion des utilisateurs</h2>
  </div>

  <table class="modern-table">

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
        <?php foreach ($users as $user): 
        $date = new DateTime($user['date_inscription']); ?>
    <tr>
      <td><?= htmlspecialchars($user['id']) ?></td>
      <td><?= htmlspecialchars($user['nom']) ?></td>
      <td><?= htmlspecialchars($user['prenom']) ?></td>
      <td><?= htmlspecialchars($user['email']) ?></td>
      <td><?= htmlspecialchars($user['user_role']) ?></td>
      <td><?= $date->format('d/m/Y') ?></td>
      <td><?= htmlspecialchars($user['nom_niveau']) ?></td>
      <td><?= htmlspecialchars($user['nom_departement']) ?></td>
      <td>
        <?php if($user['user_role'] === 'admin'){
            echo "Admin";
        }else{
        ?>
        <form action="/Memoire/actions/deleteUser.php" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
          <input type="hidden" name="id" value="<?= $user['id'] ?>">
          <button type="submit">Supprimer</button>
        </form>
        <?php } ?>
      </td>
    </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun utilisateur inscrit dans la plateforme pour le moment.</p>
    <?php endif; ?>

</div>
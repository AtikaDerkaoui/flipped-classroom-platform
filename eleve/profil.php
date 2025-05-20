<?php
session_start();
require_once '../connexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: ../pages/login.php");
    exit();
}

$sql = "SELECT departements.nom_departement AS nom_departement,
        niveaux.nom_niveau AS nom_niveau,
        utilisateurs.nom AS nom_eleve, 
        utilisateurs.prenom AS prenom_eleve
        FROM utilisateurs
        JOIN niveaux ON utilisateurs.id_niveau = niveaux.id_niveau
        JOIN departements ON utilisateurs.id_departement = departements.id_departement
        WHERE utilisateurs.id = :user_id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$eleve = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer le niveau et département actuels en cas de non modification de ceux ci
$stmt_user = $conn->prepare("SELECT id_niveau, id_departement FROM utilisateurs WHERE id = :id");
$stmt_user->bindParam(':id', $_SESSION['user_id']);
$stmt_user->execute();
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);
$id_niveau_actuel = $user['id_niveau'];
$id_departement_actuel = $user['id_departement'];


// ================= Head =================
$titre = "DzDucation - Mon profil"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>

<body>
<!-- ================= Header ================= -->

<?php require_once(__DIR__.'/../includes/header-eleve.php');
?>

<!-- ============= Navbar de bienvenu ============= -->
<section class="bienvenu-navbar space-between">
    <h3 class="left-part">Mon profil</h3>
    <h3><a href="#" class="right-part">Guide d'utilisation</a></h3>
</section>

<!-- ============= Dashboard ============= -->
<section class="dashboard space-between">
    <div class="left-part">
        <?php
            $nav_items = [
                'profil' => 'Profil',
                'modifier-infos' => 'Modifier les informations',
                'logout' => 'Se déconnecter',
                // $key => $label
            ];
            $page = $_GET['page'] ?? '';
        ?>
        <ul>
            <?php foreach ($nav_items as $key => $label): ?>
            <li>
                <a href="profil.php?page=<?= $key ?>" class="<?= ($page == $key) ? 'active' : '' ?>">
                    <?= $label ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="right-part">
        <?php 
        // Récupérer la page depuis l’URL
        $page = $_GET['page'] ?? 'profil';

        // Inclure dynamiquement la bonne page
        switch ($page) {
        case 'modifier-infos':?>
            <h1>Modifier mes informations</h1>
            <?php require_once(__DIR__.'/../includes/modifyProfil-form.php');?>

            <?php break;
        case 'logout': ?>
            <h1>Se déconnecter</h1>
            <?php break;
        case 'profil': 
            default: ?>
            <h1>Mes informations</h1>
            <h4>Nom : <span><?php echo $_SESSION['nom']; ?></span></h4>
            <h4>Prénom : <span><?php echo $_SESSION['prenom']; ?></span></h4>
            <h4>Email : <span><?php echo $_SESSION['email']; ?></span></h4>
            <h4>Role : <span><?php echo $_SESSION['role']; ?></span></h4>
            <h4>Département : <span><?= htmlspecialchars($eleve['nom_departement']) ?></span></h4>
            <h4>Niveau : <span><?= htmlspecialchars($eleve['nom_niveau']) ?></span></h4>

            <br><hr><br>
            <form action="../actions/deleteAccount.php" method="post" class="form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

                <button type="submit" name="supprimer-compte">Supprimer le compte</button>
                <p>Attention ! votre compte sera supprimé définitivement.</p>
            </form>
            <?php break;
        }
        ?>
    </div>
</section>
</body>
</html>

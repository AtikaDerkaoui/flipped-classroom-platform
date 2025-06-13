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

<?php require_once(__DIR__.'/../includes/header-member.php');
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
                'infos' => 'Mes informations',
                'modifier-infos' => 'Modifier mes informations',
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
            <li><a href="/Memoire/actions/logoutAction.php">Se déconnecter</a></li>

        </ul>
    </div>

    <div class="right-part flex-centered">
        <?php 
        // Récupérer la page depuis l’URL
        $page = $_GET['page'] ?? 'profil';

        // Inclure dynamiquement la bonne page
        switch ($page) {
        case 'modifier-infos':?>
            <?php require_once(__DIR__.'/../includes/modifyProfil-form.php');?>

            <?php break;
        case 'profil': 
            default: ?>
            <?php require_once(__DIR__.'/../includes/profilInfos.php');?>
            <?php break;
        }
        ?>
    </div>
</section>
</body>
</html>

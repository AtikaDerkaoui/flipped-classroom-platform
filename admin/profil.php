<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// ================= Head =================
$titre = "DzDucation - Mon profil"; // titre de la page
require_once(__DIR__.'/../includes/head.php');
?>

<body>
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
        
        case 'infos': 
            default: ?>
            <?php require_once(__DIR__.'/../includes/profilInfos.php');?>
            <?php break;
        }
        ?>
    </div>
</section>
</body>
</html>

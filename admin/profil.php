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
<?php require_once(__DIR__.'/../includes/header-admin.php');
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
            <?php break;
        }
        ?>
    </div>
</section>
</body>
</html>

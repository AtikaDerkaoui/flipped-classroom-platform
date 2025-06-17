<?php
session_start();

// Le head
$titre = "DzDucation - Ressources"; // titre de la page
require_once(__DIR__.'/../includes/head.php');

$page = $_GET['page'] ?? ''; // page actuelle

?>


<body>
<?php if(isset($_SESSION['user_id'])):
   require_once(__DIR__.'/../includes/header-member.php');
else:
   require_once(__DIR__.'/../includes/header.php');
endif;?>

<?php 
?>
<div class="ressources-container">
<?php // Afficher la page correspondante
switch ($page) {
    case 'ress2':
        include 'ressources/ress2.php';
        break;

    case 'ress3':
        include 'ressources/ress3.php';
        break;
    
    case 'faq':
        include 'ressources/faq.php';
        break;
    case 'guide':
        include 'ressources/guide.php';
        break;
    
    case 'ress1':
        default:
        include 'ressources/ress1.php';
        break;
}
?>
</div>
</body>
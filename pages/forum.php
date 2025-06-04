<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Le head
$titre = "DzDucation - Forum"; // titre de la page
require_once(__DIR__.'/../includes/head.php');


?>


<body>
  <?php require_once(__DIR__.'/../includes/header-forum.php');
  ?>
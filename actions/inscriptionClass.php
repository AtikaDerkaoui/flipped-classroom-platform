<?php
session_start();
require_once '../connexion.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'eleve') {
    header("Location: ../pages/login.php");
    exit;
}

// =======================================================
// ============== L'élève quitte la classe ===============
// =======================================================
if (isset($_POST['quitter-classe']) && isset($_POST['id_classe'])) {
    $id_classe = $_POST['id_classe']; 
    $id_eleve = $_SESSION['user_id'];

    $delete = $conn->prepare("DELETE FROM inscriptions WHERE id = :id_eleve AND id_classe = :id_classe");
    $delete->bindParam(':id_eleve', $id_eleve);
    $delete->bindParam(':id_classe', $id_classe);
    $delete->execute();

    header("Location: ../eleve/pages/classe.php?page2=classe-details&id_classe=$id_classe");
    exit;
}
// =======================================================
// ============== L'élève rejoint la classe ===============
// =======================================================
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code_classe = $_POST['code_classe'];
    $id_classe = $_POST['id_classe']; 
    $id_eleve = $_SESSION['user_id'];

    // Vérifier si le code correspond à une classe
    $stmt = $conn->prepare("SELECT id_classe FROM classes WHERE code_classe = :code_classe");
    $stmt->bindParam(':code_classe', $code_classe);
    $stmt->execute();
    $classe = $stmt->fetch();

    if ($classe) {
        $id_classe = $classe['id_classe'];

        // Vérifier que l'élève n'est pas déjà inscrit
        $verif = $conn->prepare("SELECT * FROM inscriptions WHERE id = :id_eleve AND id_classe = :id_classe");
        $verif->bindParam(':id_eleve', $id_eleve);
        $verif->bindParam(':id_classe', $id_classe);
        $verif->execute();

        if ($verif->rowCount() === 0) {
            // Insérer l'inscription
            $insert = $conn->prepare("INSERT INTO inscriptions (id, id_classe, date_inscription) 
                                      VALUES (:id_eleve, :id_classe, NOW())");
            $insert->bindParam(':id_eleve', $id_eleve);
            $insert->bindParam(':id_classe', $id_classe);
            $insert->execute();
        }
    } else {
        // code de classe entré faux
        $_SESSION['message'] = "Le code que vous avez rentré est erroné, réessayer.";
    }

    header("Location: ../eleve/pages/classe.php?page2=classe-details&id_classe=$id_classe");
    exit;
}

?>


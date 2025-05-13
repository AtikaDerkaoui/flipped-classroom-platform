<?php
session_start();
require_once '../connexion.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] === 'eleve') {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code_classe = $_POST['code_classe'];
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

            header("Location: ../eleve/pages/classes-inscrites.php");
            exit;
        } else {
            echo "Vous êtes déjà inscrit à cette classe.";
        }
    } else {
        echo "Code de classe invalide.";
    }
}
?>

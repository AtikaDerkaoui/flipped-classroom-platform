<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['submit'])) {
    $nom_classe = $_POST['nom_classe'];
    $id_departement = $_POST['id_departement'];
    $id_niveau = $_POST['id_niveau'];
    $module = $_POST['module'];
    $code_classe = $_POST['code_classe'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM classes WHERE code_classe = :code_classe");
    $stmt->execute([':code_classe' => $code_classe]);
    $code_exists = $stmt->fetchColumn();

    if ($code_exists > 0) {
        $_SESSION['erreur_code'] = "Oups ! Ce code est déjà utilisé pour une autre classe.";
        header("Location: ../enseignant/dashboard.php?page=classes");
        exit;
    }

    // id_enseignant
    $id_enseignant = $_SESSION['user_id'];

    // Insérer la classe dans la base de données
    $sql = "INSERT INTO classes (nom_classe, id_departement, id_niveau, module, code_classe, id_enseignant) VALUES (:nom_classe, :id_departement, :id_niveau, :module, :code_classe, :id_enseignant)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_classe', $nom_classe);
    $stmt->bindParam(':id_departement', $id_departement);
    $stmt->bindParam(':id_niveau', $id_niveau);
    $stmt->bindParam(':module', $module);
    $stmt->bindParam(':code_classe', $code_classe);
    $stmt->bindParam(':id_enseignant', $id_enseignant);
    $stmt->execute();

    header("Location: ../enseignant/dashboard.php?page=classes");
    exit;
}
?>
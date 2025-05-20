<?php
session_start();
// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['modifier']) && isset($_SESSION['user_id'])) {
    $nom = ucfirst(strtolower(trim($_POST['nom'])));
    $prenom = ucfirst(strtolower(trim($_POST['prenom'])));
    $email = $_POST['email'];

    $user_id = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    // Si l'élève, récupérer aussi niveau et département
    if ($role === 'eleve') {
        $id_niveau = $_POST['id_niveau'];
        $id_departement = $_POST['id_departement'];
    }

    // Vérifier si un mot de passe a été saisi
    if (!empty($_POST['mot_de_passe'])) {
        $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

        // Requête avec mise à jour du mot de passe
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe";
        if ($role === 'eleve') {
            $sql .= ", id_departement = :id_departement, id_niveau = :id_niveau";
        }
        $sql .= " WHERE id = :user_id";

        $stmt = $conn->prepare($sql);

        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe,
            ':user_id' => $user_id
        ];
        if ($role === 'eleve') {
            $params[':id_departement'] = $id_departement;
            $params[':id_niveau'] = $id_niveau;
        }

    } else {
        // Requête sans mise à jour du mot de passe
        $sql = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email";
        if ($role === 'eleve') {
            $sql .= ", id_departement = :id_departement, id_niveau = :id_niveau";
        }
        $sql .= " WHERE id = :user_id";

        $stmt = $conn->prepare($sql);

        $params = [
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':user_id' => $user_id
        ];
        if ($role === 'eleve') {
            $params[':id_departement'] = $id_departement;
            $params[':id_niveau'] = $id_niveau;
        }
    }

    // Exécuter la requête
    $stmt->execute($params);

    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['email'] = $email;

    if ($role == 'eleve'){
        $_SESSION['id_departement'] = $id_departement;
        $_SESSION['id_niveau'] = $id_niveau;

        header("Location: ../eleve/profil.php?page=modifier-infos");
        exit;
    }

    header("Location: ../enseignant/profil.php?page=modifier-infos");
    exit;
}
?>
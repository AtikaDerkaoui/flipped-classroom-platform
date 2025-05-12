<?php
session_start();

// Inclure le fichier de connexion
require_once '../connexion.php';

if (isset($_POST['submit'])) {
    $nom = ucfirst(strtolower(trim($_POST['nom'])));
    $prenom = ucfirst(strtolower(trim($_POST['prenom'])));
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];
    $id_niveau = $_POST['id_niveau'];
    $id_departement = $_POST['id_departement'];


    // Vérification que l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Adresse email invalide.";
    } else {
        // Vérifier si l'email existe déjà
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur) {
            $_SESSION['message'] = "Cet email est déjà utilisé.";
        } else {
        // Hacher le mot de passe
            $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            // Insérer l'utilisateur dans la base de données
            $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, id_niveau, id_departement) VALUES (:nom, :prenom, :email, :mot_de_passe, :role, :id_niveau, :id_departement)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe_hache);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id_niveau', $id_niveau);
            $stmt->bindParam(':id_departement', $id_departement);


            $stmt->execute();

            $_SESSION['message'] = "Inscription réussie ! Vous pouvez vous connecter maintenant.";
        }
    }

     // Redirection vers la page d'inscription
     header("Location: ../pages/register.php");
     exit;
}

if (isset($message)) {
    echo "<p style='color:red;'>$message</p>";
}
?>
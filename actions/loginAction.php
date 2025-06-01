<?php
// Inclure le fichier de connexion
require_once '../connexion.php';

session_start(); // Démarre la session pour la gestion de l'utilisateur connecté

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        // Si le mot de passe est correct, on crée une session pour l'utilisateur
        $_SESSION['user_id'] = $utilisateur['id'];
        $_SESSION['nom'] = $utilisateur['nom'];
        $_SESSION['prenom'] = $utilisateur['prenom'];
        $_SESSION['email'] = $utilisateur['email'];
        $_SESSION['role'] = $utilisateur['role'];
        $_SESSION['id_niveau'] = $utilisateur['id_niveau'];
        $_SESSION['id_departement'] = $utilisateur['id_departement'];


        // Redirige l'utilisateur vers le tableau de bord
        if($_SESSION['role'] == 'eleve'){
            header("Location: ../eleve/dashboard.php");
        }elseif($_SESSION['role'] == 'enseignant'){
            header("Location: ../enseignant/dashboard.php");
        }else{
            header("Location: ../admin/dashboard.php");
        }
        exit();
    } else {
        $_SESSION['message'] = "Email ou mot de passe incorrect, réessayer une autre fois.";

        // Redirection vers la page login
        header("Location: ../pages/login.php");
        exit;
    }

}
if (isset($message)) {
    echo "<p style='color:red;'>$message</p>";
}
?>

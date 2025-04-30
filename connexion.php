<?php
// Inclusion du fichier de configuration
require_once 'config/config.php';

try {
    // Création de la connexion PDO
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);

    // Activation des erreurs PDO en mode exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    // Affichage d'une erreur claire si la connexion échoue
    die("Erreur de connexion : " . $e->getMessage());
}
?>

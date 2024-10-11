<?php
session_start(); // Démarre la session


// Connexion à la base de données
$host = 'localhost';
$db   = 'voandalana';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assainir et valider les entrées utilisateur
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $mot_de_passe = $_POST['mot_de_passe'];

        if (!$email) {
            echo "Email invalide.";
            exit;
        }

        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            echo "Cet email est déjà enregistré. Veuillez vous connecter.";
            exit;
        }

        // Hacher le mot de passe
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");
        $stmt->execute(['nom' => $nom, 'email' => $email, 'mot_de_passe' => $hashed_password]);

        echo "Inscription réussie !";
    }
} 

catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

if (isset($_SESSION['utilisateur'])) {
    header("Location: ../index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Token CSRF invalide");
    }
    // Traiter les autres données
}

?>


<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "eclat_floral";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Vérifie si les mots de passe correspondent
    if ($pass !== $confirm) {
        echo "<script>alert('Les mots de passe ne correspondent pas');</script>";
    } else {
        // Vérifie si l'email existe déjà
        $stmt = $conn->prepare("SELECT user_email FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Cet email existe déjà');</script>";
        } else {
            // Hachage du mot de passe
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insertion dans la base
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_firstname, user_email, user_password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $firstname, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Inscription réussie !'); window.location.href='./log-in.php';</script>";
                exit();
            } else {
                echo "<script>alert('Erreur lors de l\'inscription');</script>";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion – Éclat Floral</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="left-panel">
            <img src="../image/avatar.jpg" alt="Éclat Floral Logo" class="logo-icon" />
            <h1>Éclat Floral</h1>
            <h2>Cultiver l’avenir</h2>
            <p>
                Inspirées par la nature et guidées par l’émotion, nos créations florales éveillent les sens et embellissent chaque instant.
            </p>
        </div>

        <div class="right-panel">
            <div class="login-card">
                <p class="welcome">Commençons dès maintenant</p>
                <h3>Créer un compte</h3>

                <form method="POST">
                    <input type="text" name="name" placeholder="Nom" required />
                    <input type="text" name="firstname" placeholder="Prénom" required />
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="password" name="password" placeholder="Mot de passe" required />
                    <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required />
                    <button type="submit">CONTINUER</button>
                </form>

                <div class="divider">OU</div>

                <div class="social-logins">
                    <button class="google">Continuer avec Google</button>
                    <button class="facebook">Continuer avec Facebook</button>
                    <button class="apple">Continuer avec Apple</button>
                </div>

                <p class="signup">
                    Nouveau sur notre site ? <a href="./log-in.php">Connectez-vous !</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>

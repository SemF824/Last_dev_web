<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "eclat_floral";

try {

    $conn = new mysqli($host, $user, $password, $db);
} catch (\Throwable $th) {
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    try {

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<script>alert('Connexion réussie !');</script>";
        } else {
            echo "<script>alert('Identifiants invalides');</script>";
        }
    } catch (\Throwable $th) {
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

                <form>
                    <input type="text" placeholder="Nom et prénom" value="Jonhson Doe" required />

                    <input type="email" placeholder="Email" value="johnsbrooks@gmail.com" required />

                    <input type="password" placeholder="Mot de passe" value="*************" required />

                    <input type="password" name="password" placeholder="Confirmer le mot de passe" value="*************" required>


                    <div class="options">
                    </div>

                    <button type="submit">CONTINUER</button>
                </form>

                <div class="divider">OU</div>

                <div class="social-logins">
                    <button class="google">S'inscrire avec Google</button>
                    <button class="facebook">S'inscrire avec Facebook</button>
                    <button class="apple">S'inscrire avec Apple</button>
                </div>

                <p class="signup">
                    Nouveau sur notre site ? <a href="./log-in.php"><Connectez-vous>Connectez-vous !</Connectez-vous></a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
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
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Vérifier l'existence de l'utilisateur
    $stmt = $conn->prepare("SELECT user_password FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password);
        $stmt->fetch();

        // Vérifier le mot de passe haché
        if (password_verify($pass, $db_password)) {
            echo "<script>alert('Connexion réussie'); window.location.href='../main.html';</script>";
            exit();
        } else {
            echo "<script>alert('Mot de passe incorrect');</script>";
        }
    } else {
        echo "<script>alert('Email non trouvé');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion – Éclat Floral</title>
  <link rel="stylesheet" href="./login.css">
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
        <p class="welcome">Heureux de vous revoir !</p>
        <h3>Connectez-vous à votre compte</h3>

       <form method="POST">
          <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
          <div class="options">
            <label><input type="checkbox" checked /> Se souvenir de moi</label>
            <a href="#" style="color: black">Mot de passe oublié ?</a>
          </div>
         <button type="submit">SE CONNECTER</button>

        </form>

        <div class="divider">OU</div>

        <div class="social-logins">
          <button class="google">Se connecter avec Google</button>
          <button class="facebook">Se connecter avec Facebook</button>
          <button class="apple">Se connecter avec Apple</button>
        </div>

        <p class="signup">
          Nouvel utilisateur ?<a href="./sign-in.php"><Inscrivez-vous>Inscrivez-vous ! </Inscrivez-vous></a>

        </p>
      </div>
    </div>
  </div>
</body>

</html>

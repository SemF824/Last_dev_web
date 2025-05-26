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
</head>

<body>
  <div class="login-wrapper">
    <div class="left-panel">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Eo_circle_green_white_checkmark.svg/1024px-Eo_circle_green_white_checkmark.svg.png" alt="Éclat Floral Logo" class="logo-icon" />
      <h1>Éclat Floral</h1>
      <h2>Cultiver l’avenir…</h2>
      <p>
        Inspirées par la nature et guidées par l’émotion, nos créations florales éveillent les sens et embellissent chaque instant.
      </p>
    </div>

    <div class="right-panel">
      <div class="login-card">
        <p class="welcome">Heureux de vous revoir !</p>
        <h3>Connectez-vous à votre compte</h3>

        <form>
          <input type="email" placeholder="Email" value="johnsbrooks@gmail.com" required />
          <input type="password" placeholder="Mot de passe" value="*************" required />
          <div class="options">
            <label><input type="checkbox" checked /> Se souvenir de moi</label>
            <a href="#">Mot de passe oublié ?</a>
          </div>
          <button type="submit">CONTINUER</button>
        </form>

        <div class="divider">OU</div>

        <div class="social-logins">
          <button class="google">Se connecter avec Google</button>
          <button class="facebook">Se connecter avec Facebook</button>
          <button class="apple">Se connecter avec Apple</button>
        </div>

        <p class="signup">
          Nouveau utilisateur ? <a href="#">INSCRIVEZ-VOUS ICI</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>

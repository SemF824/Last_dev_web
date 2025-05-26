<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "your_database"; // change this to your DB name

$conn = new mysqli($host, $user, $password, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "<script>alert('Connexion réussie !');</script>";
    } else {
        echo "<script>alert('Identifiants invalides');</script>";
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
  <div class="container">
    <div class="left">
      <img src="logo.png" alt="Éclat Floral Logo" class="logo" />
      <h1>Éclat Floral</h1>
      <h2>Cultiver l’avenir...</h2>
      <p>Inspirées par la nature et guidées par l’émotion, nos créations florales éveillent les sens et embellissent chaque instant.</p>
    </div>

    <div class="right">
      <form method="post">
        <p class="welcome">Heureux de vous revoir</p>
        <h2>Connectez-vous à votre compte</h2>
        
        <input type="email" name="email" placeholder="Email" required>
        
        <div class="password-field">
          <input type="password" name="password" placeholder="Mot de passe" id="password" required>
          <span onclick="togglePassword()">👁️</span>
        </div>
        
        <div class="options">
          <label><input type="checkbox"> Se souvenir de moi</label>
          <a href="#">Mot de passe oublié ?</a>
        </div>
        
        <button type="submit">CONTINUE</button>
        
        <div class="divider">Ou</div>
        
        <div class="social-buttons">
          <button type="button"><img src="https://img.icons8.com/color/48/google-logo.png"/> Se connecter avec Google</button>
          <button type="button"><img src="https://img.icons8.com/color/48/facebook-new.png"/> Se connecter avec Facebook</button>
          <button type="button"><img src="https://img.icons8.com/ios-filled/50/mac-os.png"/> Se connecter avec Apple</button>
        </div>
        
        <p class="signup">Nouveau utilisateur ? <a href="#"><strong>INSCRIVEZ-VOUS ICI</strong></a></p>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const pwd = document.getElementById("password");
      pwd.type = pwd.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>

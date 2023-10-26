<?php
session_start();

// Connexion à la base de données
$conn = mysqli_connect('localhost', 'test', 'test', 'crud');

// Vérifier si la connexion a réussi
if (!$conn) {
  die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['login'])) {
  // Récupérer les données du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Requête pour récupérer l'utilisateur correspondant au nom d'utilisateur
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  // Vérifier si l'utilisateur existe
  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Vérifier si le mot de passe est correct
    if (password_verify($password, $user['password'])) {
      // Authentification réussie
      $_SESSION['user_id'] = $user['id'];
      header('Location: index.php');
      exit;
    } else {
      // Mot de passe incorrect
      $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
  } else {
    // Utilisateur non trouvé
    $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
  }
}

// Vérifier si le formulaire d'inscription a été soumis
if (isset($_POST['register'])) {
  // Récupérer les données du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Vérifier si l'utilisateur existe déjà
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Utilisateur déjà enregistré
    $error = 'Nom d\'utilisateur déjà utilisé.';
  } else {
    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // Inscription réussie
      $success = 'Inscription réussie. Veuillez vous connecter.';
    } else {
      // Erreur lors de l'inscription
      $error = 'Erreur lors de l\'inscription.';
    }
  }
}

// Fermer la connexion
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Page de login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">Page de login</h1>
          </div>
          <div class="card-body">
            <?php if (isset($error)): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
              <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="post">
              <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
                <button type="submit" class="btn btn-secondary" name="register">S'inscrire</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
          integrity="sha384-7zVJZz8g3z5zJjvzqJZ6f0JzJvK6QJZ7J6yJ8Qz3JZv8z3JzJ5yJzJzJ5yJzJzJz"
          crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
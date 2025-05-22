<!DOCTYPE html>
<?php session_start(); $_SESSION["log"]=FALSE ?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="min-width: 350px;">
      <form action="log.php" method="post">
        <h2 class="mb-4 text-center">Login</h2>
        <div class="mb-3">
          <label for="mail" class="form-label">Username</label>
          <input type="text" required name="mail" id="mail" class="form-control">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" required name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">Log In</button>
        <?php
        if(isset($_SESSION["errLog"])&&$_SESSION["errLog"])
          echo "<p class='mt-3 text-danger text-center' style='font-size: 1.2rem;'>Password o utente errati</p>";
        ?>
      </form>
    </div>
  </div>
</body>
</html>
<?php
session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE)
    header("refresh:0; url=index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuova Azienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="classi.php" class="btn btn-secondary ms-2"><--</a><br><br>
    <h3>Inserisci Nuova Azienda</h3>
    <form action="save_class.php" method="POST">
        <input type="hidden" name="az" value="TRUE">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>
        <div class="mb-3">
            <label for="specializzazione" class="form-label">Specializzazione:</label>
            <input type="text" class="form-control" name="specializzazione" id="specializzazione" required>
        </div>
        <button type="submit" class="btn btn-success">Inserisci</button>  
    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<?php session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE)
    header("refresh:0; url=index.php");

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);
if(!$_SESSION["global"]){
    $classi=$db->query("SELECT * FROM classi WHERE coordinatore='$_SESSION[id]' ORDER BY anno DESC")->fetch_all(MYSQLI_ASSOC);
}else{
    $classi=$db->query("SELECT * FROM classi ORDER BY anno DESC")->fetch_all(MYSQLI_ASSOC);
}

$db->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <title>Classi</title>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-end">
        <?php if ($_SESSION["global"] == true): ?>
            <a href="register.php" class="btn btn-primary ms-2">Registrazione utenti</a>
            <a href="aziende.php" class="btn btn-primary ms-2">Registrazione azienda</a>
            <a href="new_class.php" class="btn btn-primary ms-2">Nuova classe</a>
        <?php endif; ?>
        <div style="width: 10px;"></div>
        <form action="logout.php" style="direction: rtl;"><input type="submit" class="btn btn-danger" value="Logout"></form>
    </div>
    <div class="container mt-5">
        <h3>Selezionare la classe:</h3><br>
        <?php
        foreach($classi as $c ){
        echo "
        <form action='page.php' method='post'>
            <button class='btn btn-primary' type='submit' name='button' value='$c[id]'>$c[nome] $c[indirizzo] $c[anno]</button>
        </form><br>";
        }
    ?>
    </div>
</body>
</html>
<?php
session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE)
    header("refresh:0; url=index.php");

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);

// Recupera i professori per la select
$professori = $db->query("SELECT * FROM prof ORDER BY cognome")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuova Classe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="classi.php" class="btn btn-secondary ms-2"><--</a><br><br>
    <h3>Inserisci Nuova Classe</h3>
    <form action="save_class.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>
        <div class="mb-3">
            <label for="indirizzo" class="form-label">Indirizzo:</label>
            <input type="text" class="form-control" name="indirizzo" id="indirizzo" required>
        </div>
        <div class="mb-3">
            <label for="anno" class="form-label">Anno:</label>
            <input type="number" class="form-control" name="anno" id="anno" required min="2024" max="2100" step="1" placeholder="2025">
        </div>
        <div class="mb-3">
            <label for="coordinatore" class="form-label">Coordinatore:</label>
            <select class="form-select" name="coordinatore" id="coordinatore" required>
                <option value="" selected disabled>Seleziona un professore</option>
                <?php foreach ($professori as $prof): ?>
                    <option value="<?= $prof['id'] ?>"><?=$prof['nome'].' '.$prof['cognome']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Inserisci</button>  
    </form>
</div>
</body>
</html>
<?php $db->close(); ?>
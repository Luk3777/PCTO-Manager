<?php session_start(); 
    if($_SESSION["log"]==FALSE)
        header( "refresh:0; url=index.php" ); 

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);

$stud=$db->query("SELECT * FROM studenti WHERE id='$_REQUEST[stud]'")->fetch_all(MYSQLI_ASSOC);
if(isset($_REQUEST["edit"])){
    $result=$db->query("SELECT att.id, studente_id, data, ore, note, azienda_id, nome, specializzazione FROM attivita att JOIN aziende a ON azienda_id=a.id WHERE studente_id='$_REQUEST[stud]' AND att.id='$_REQUEST[edit]' ORDER BY data ASC")->fetch_all(MYSQLI_ASSOC);
    foreach($result as $row){
        $old=$row;
    }
}else{
    $result=$db->query("SELECT att.id, studente_id, data, ore, note, nome, specializzazione FROM attivita att JOIN aziende a ON azienda_id=a.id WHERE studente_id='$_REQUEST[stud]' ORDER BY data ASC")->fetch_all(MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <title>Edit</title>
</head>
<body><?php if(isset($_REQUEST['edit'])){
    echo "
    <div class='container mt-5'>
        <h3>Modifica Attività per ".$stud[0]['cognome'].' '.$stud[0]['nome']."</h3>
        <form action='update.php?edit=$_REQUEST[edit]' method='POST'>
            <input type='hidden' name='studente_id' value='" .$_REQUEST['stud']. "'>
            <div class='mb-3'>
                <label for='data'>Data:</label>
                <input type='date' class='form-control' name='data' id='data' value='" . htmlspecialchars($old['data']) . "' required>
            </div>
            <div class='mb-3'>
                <label for='ore'>Ore:</label>
                <input type='number' class='form-control' name='ore' id='ore' min='1' value='" . htmlspecialchars($old['ore']) . "' required>
            </div>
            <div class='mb-3'>
                <label for='note'>Note:</label>
                <textarea class='form-control' name='note' id='note' required>".htmlspecialchars($old['note'])."</textarea>
            </div>
            <div class='mb-3'>
                <label for='azienda_id'>Azienda:</label>
                <select class='form-select' name='azienda_id' id='azienda_id' required>
                    <option value='' disabled>Seleziona un'azienda</option>";
                    $aziende = $db->query("SELECT * FROM aziende ORDER BY nome;")->fetch_all(MYSQLI_ASSOC);
                    foreach ($aziende as $az) {
                        $selected = ($az['id'] == $old['azienda_id']) ? "selected" : "";
                        echo "<option value='$az[id]' $selected>".htmlspecialchars($az['nome'].' ('.$az['specializzazione'].")")."</option>";
                    }
                    echo "
                </select>
            </div>
            <button class='btn btn-secondary' type='button' onclick=\"window.location.href='attivita.php?stud=$_REQUEST[stud]'\"><--</button>
            <button class='btn btn-warning' type='submit'>Aggiorna</button>
        </form>
    </div>";
}else{
    echo "
    <div class='container mt-5'>
        <h3>Inserisci nuova Attività per ".$stud[0]['cognome'].' '.$stud[0]['nome']."</h3>
        <form action='update.php' method='POST'>
            <input type='hidden' name='studente_id' value='" .$_REQUEST['stud']. "'>
            <div class='mb-3'>
                <label for='data'>Data:</label>
                <input type='date' class='form-control' name='data' id='data' required>
            </div>
            <div class='mb-3'>
                <label for='ore'>Ore:</label>
                <input type='number' class='form-control' name='ore' id='ore' min='1' required>
            </div>
            <div class='mb-3'>
                <label for='note'>Note:</label>
                <textarea class='form-control' name='note' id='note' required></textarea>
            </div>
            <div class='mb-3'>
                <label for='azienda_id'>Azienda:</label>
                <select class='form-select' name='azienda_id' id='azienda_id' required>
                    <option value='' selected disabled>Seleziona un'azienda</option>";
                    $aziende = $db->query("SELECT * FROM aziende ORDER BY nome;")->fetch_all(MYSQLI_ASSOC);
                    foreach ($aziende as $az) {
                        echo "<option value='$az[id]'>".$az['nome'].' ('.$az['specializzazione'].")</option>";
                    }
                    echo "
                </select>
            </div>
            <button class='btn btn-secondary' type='button' onclick=\"window.location.href='attivita.php?stud=$_REQUEST[stud]'\"><--</button>
            <button type='submit' class='btn btn-success'>Inserisci</button>
        </form>
    </div>";
}
$db->close();
?>
</body>
</html>
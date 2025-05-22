<?php
session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE)
    header("refresh:0; url=index.php");

if (
    isset($_POST['nome']) &&
    isset($_POST['indirizzo']) &&
    isset($_POST['anno']) &&
    isset($_POST['coordinatore'])
) {
    $db = new mysqli("localhost", "root", "", "pcto");
    if ($db->connect_error)
        die("Connection failed: " . $db->connect_error);

    $id = $db->real_escape_string($_POST['id']);
    $nome = $db->real_escape_string($_POST['nome']);
    $indirizzo = $db->real_escape_string($_POST['indirizzo']);
    $anno = intval($_POST['anno']);
    $coordinatore = intval($_POST['coordinatore']);

    $sql = "INSERT INTO classi (nome, indirizzo, anno, coordinatore) VALUES ('$nome', '$indirizzo', $anno, $coordinatore)";
    if ($db->query($sql)) {
        header("Location: classi.php");
    } else {
        echo "Errore nell'aggiornamento: " . $db->error;
        header("refresh:3; Location: new_class.php");
    }
    $db->close();
} elseif (isset($_POST['az'])) {
    $db = new mysqli("localhost", "root", "", "pcto");
    if ($db->connect_error)
        die("Connection failed: " . $db->connect_error);

    $nome = $db->real_escape_string($_POST['nome']);
    $specializzazione = $db->real_escape_string($_POST['specializzazione']);

    $sql = "INSERT INTO aziende (nome, specializzazione) VALUES ('$nome', '$specializzazione')";
    if ($db->query($sql)) {
        header("Location: classi.php");
    } else {
        echo "Errore nell'inserimento: " . $db->error;
        header("refresh:3; Location: aziende.php");
    }
    $db->close();
} else {
    header("Location: new_class.php");
    exit();
}
?>
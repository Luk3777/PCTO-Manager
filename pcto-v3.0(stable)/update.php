<?php session_start(); 
    if($_SESSION["log"]==FALSE|| $_SESSION["stud"] == TRUE)
        header( "refresh:0; url=index.php" );

    $db = new mysqli("localhost", "root", "", "pcto");
    if ($db->connect_error)
        die("Connection failed: " . $db->connect_error);
if(!isset($_REQUEST['edit'])){
    $data = $db->real_escape_string($_POST['data']);
    $ore = (int)$_POST['ore'];
    $note = $db->real_escape_string($_POST['note']);
    $azienda_id = (int)$_POST['azienda_id'];
    $studente_id = (int)$_POST['studente_id'];

    $query = "INSERT INTO attivita (data, ore, note, azienda_id, studente_id) VALUES ('$data', $ore, '$note', $azienda_id, $studente_id)";
    if ($db->query($query)) {
        header("Location: attivita.php?stud=$studente_id");
    } else {
        echo "Errore nell'inserimento: " . $db->error;
        header("refresh:3; Location: attivita.php?stud=$studente_id");
    }
} else{
    $data = $db->real_escape_string($_POST['data']);
    $ore = (int)$_POST['ore'];
    $note = $db->real_escape_string($_POST['note']);
    $azienda_id = (int)$_POST['azienda_id'];
    $edit_id = (int)$_REQUEST['edit'];
    $studente_id = (int)$_POST['studente_id'];

    $query = "UPDATE attivita SET data='$data', ore=$ore, note='$note', azienda_id=$azienda_id WHERE id=$edit_id";
    if ($db->query($query)) {
        header("Location: attivita.php?stud=$studente_id");
    } else {
        echo "Errore nell'aggiornamento: " . $db->error;
        header("refresh:3; Location: attivita.php?stud=$studente_id");
    }
}
$db->close();
?>
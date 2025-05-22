<?php
session_start(); 
if($_SESSION["log"]==FALSE)
    header( "refresh:0; url=index.php" ); 
$db=new mysqli("localhost","root","","pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);
if (isset($_GET['Id_att'])) {
    $id_a = isset($_GET['Id_att']) ? intval($_GET['Id_att']) : 0;
    if ($id_a > 0) {
        $db->query("DELETE FROM attivita WHERE id = $id_a");
        echo 'Attività eliminata con successo.';
        header("refresh:2; url=attivita.php?stud=".$_REQUEST['stud']);
    } else {
        echo 'ID attività non valido.';
    }
}elseif(isset($_REQUEST["Dstud"])){
    $db->query("UPDATE studenti SET classe_id=NULL WHERE id = '$_REQUEST[Dstud]'");
    echo 'Studente eliminato con successo.';
    header("refresh:2; url=page.php?button=".$_REQUEST['class']);
}
$db->close();
?>
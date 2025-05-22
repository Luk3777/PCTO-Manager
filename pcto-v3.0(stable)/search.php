<?php
session_start();
$search = $_POST['nome'];
$ore = $_POST['ore'];
$az = $_POST['az'];
$stud=$_REQUEST['stud'];
$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);

$qry = "SELECT * FROM attivita JOIN aziende a ON azienda_id=a.id WHERE studente_id='$stud'";

if ($search != '') {
    $qry .= " AND note LIKE '%$search%'";
}
if ($ore != '') {
    $qry .= " AND ore='$ore'";
}
if ($az != '') {
    $qry .= " AND a.nome LIKE '%$az%'";
}

$result = $db->query($qry.";");
$_SESSION['search_result'] = $result->fetch_all(MYSQLI_ASSOC);
$db->close();
if($qry=="SELECT * FROM attivita JOIN aziende a ON azienda_id=a.id WHERE studente_id='$stud'")
    unset($_SESSION["search_result"]);
header("refresh:0; url=attivita.php?stud=$stud");
?>
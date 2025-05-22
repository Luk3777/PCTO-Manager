<?php
session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE) {
    header("refresh:0; url=index.php");
    exit;
}

$name = trim($_POST['name']);
$sur = trim($_POST['sur']);
$act = $_POST['act'];

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error) {
    $_SESSION["error"] = "Errore connessione DB";
    header("Location: register.php");
    exit;
}

if ($act === "S") {
    $class = $_POST['class'];
    $conta = $db->query("SELECT COUNT(*) as count FROM studenti")->fetch_assoc();
    $utente = strtolower(substr($name, 0, 1) . substr($sur, 0, 1)) . ($conta['count'] + 1);
    $stmt = $db->prepare("INSERT INTO studenti (nome, cognome, utente, classe_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $sur, $utente, $class);
    if ($stmt->execute()) {
        header("Location: classi.php");
    } else {
        $_SESSION["error"] = "Errore durante la registrazione dello studente.";
        header("Location: register.php");
    }
    $stmt->close();
} else {
    $subject = trim($_POST['subject']);
    $conta = $db->query("SELECT COUNT(*) as count FROM prof")->fetch_assoc();
    $utente = strtolower(substr($name, 0, 1) . substr($sur, 0, 1)) . ($conta['count'] + 1);
    $stmt = $db->prepare("INSERT INTO prof (nome, cognome, utente, materia) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $sur, $utente, $subject);
    if ($stmt->execute()) {
        header("Location: classi.php");
    } else {
        $_SESSION["error"] = "Errore durante la registrazione del professore.";
        header("Location: register.php");
    }
    $stmt->close();
}

$db->close();
?>
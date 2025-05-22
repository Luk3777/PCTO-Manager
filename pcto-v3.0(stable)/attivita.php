<!DOCTYPE html>
<?php session_start();
if ($_SESSION["log"] == FALSE)
    header("refresh:0; url=index.php");
if($_REQUEST['stud'] != $_SESSION['id'] && $_SESSION["stud"] == true)
            header("refresh:0; url=attivita.php?stud=".$_SESSION["id"]);

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);
if($_SESSION["stud"]){
    $result=$db->query("SELECT att.id, studente_id, data, ore, note, nome, specializzazione FROM attivita att JOIN aziende a ON azienda_id=a.id WHERE studente_id='$_REQUEST[stud]' ORDER BY data ASC")->fetch_all(MYSQLI_ASSOC);
    $stud=$db->query("SELECT * FROM studenti WHERE id='$_REQUEST[stud]'")->fetch_all(MYSQLI_ASSOC);

}else{
$result=$db->query("SELECT att.id, studente_id, data, ore, note, nome, specializzazione FROM attivita att JOIN aziende a ON azienda_id=a.id WHERE studente_id='$_REQUEST[stud]' ORDER BY data ASC")->fetch_all(MYSQLI_ASSOC);
$stud=$db->query("SELECT * FROM studenti WHERE id='$_REQUEST[stud]'")->fetch_all(MYSQLI_ASSOC);
}
if (isset($_SESSION['search_result'])) {
    $result = $_SESSION['search_result'];
    unset($_SESSION['search_result']);
}
$total_ore = 0;
foreach ($result as $row) {
    $total_ore += intval($row['ore']);
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script>
        function del(code){
            if(confirm("Delete "+code+"?"))
                window.location.href="delete.php?Id_att="+code+"&stud=<?php echo $_REQUEST['stud']; ?>";
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <title>Attività</title>
</head>
<body>
    <div class="container mt-5">
    <?php if (!$_SESSION["stud"]) { ?>
        <form action='page.php' method='post'>
            <button class="btn btn-primary" type='submit' name='button' value='<?php echo $stud[0]['classe_id'] ?>'><--</button>
        </form>
    <?php } ?>
        <form action="logout.php" style="direction: rtl;"><input type="submit" class="btn btn-danger" value="Logout"></form><br>
        <form action="search.php?stud=<?php echo $_REQUEST['stud']; ?>" method="post">
            <input type="text" name="nome" id="nome" placeholder="Nome attività">
            <label for="ore">&nbsp&nbsp|&nbsp&nbsp</label>
            <input type="text" name="ore" id="ore" placeholder="Ore">
            <label for="az">&nbsp&nbsp|&nbsp&nbsp</label>
            <input type="text" name="az" id="az" placeholder="Azienda">
            <span>&nbsp&nbsp|&nbsp&nbsp</span>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>
        <button class="btn btn-primary" onclick="window.location='load.php?stud=<?php echo $_REQUEST['stud']; ?>';">Nuova attività</button>
        <br>
        <h2>Attività <?php echo $stud[0]['cognome'].' '.$stud[0]['nome'];?></h2>
        <div class="my-4">
            <div class="progress" style="height: 2.5rem;">
            <?php
                $percent = min(100, round(($total_ore / 150) * 100));
                $color = $percent >= 100 ? 'bg-success' : 'bg-primary';
            ?>
            <div class="progress-bar <?php echo $color; ?>" role="progressbar" style="width: <?php echo $percent; ?>%;" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100">
                <?php echo $total_ore . ' / 150 ore'; ?>
            </div>
        </div>
    </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Ore</th>
                    <th>Azienda</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['note']; ?></td>
                            <td><?php echo $row['data']; ?></td>
                            <td><?php echo $row['ore']; ?></td>
                            <td><?php echo $row['nome'].' ('.$row['specializzazione'].')';?></td>
                            <td>
                                <button class="btn btn-warning" onclick="window.location='load.php?edit=<?php echo $row['id']; ?>&stud=<?php echo $_REQUEST['stud']; ?>'">Edit</button>
                                <button class="btn btn-danger" onclick="del(<?php echo $row['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                <?php
                }
                     }else{
                        echo "<tr>
                                <td colspan='6'>No attivita</td>
                            </tr>";
                     }
                     $db->close();
                ?>
                    
            </tbody>
        </table>
    </div>
</body>
</html>
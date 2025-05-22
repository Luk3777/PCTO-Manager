<!DOCTYPE html>
<?php session_start();
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE)
    header("refresh:0; url=index.php");

$db = new mysqli("localhost", "root", "", "pcto");
if ($db->connect_error)
    die("Connection failed: " . $db->connect_error);

$result=$db->query("SELECT * FROM studenti WHERE classe_id='$_REQUEST[button]' ORDER BY cognome")->fetch_all(MYSQLI_ASSOC);
$classe=$db->query("SELECT * FROM classi WHERE id='$_REQUEST[button]'")->fetch_all(MYSQLI_ASSOC);

$db->close();
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
                window.location.href="delete.php?Dstud="+code+"&class=<?php echo $_REQUEST['button']?>";
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <title>Archive</title>
</head>
<body>
    <div class="container mt-5">
    <form action="logout.php" style="direction: rtl;"><input type="submit" class="btn btn-danger" value="Logout"></form>
        <button class="btn btn-primary" onclick="window.location='classi.php'"><--</button>
        <br>
        <h2>Studenti <?php echo $classe[0]['nome'].' '.$classe[0]['indirizzo'].' '.$classe[0]['anno'];?></h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cognome</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($result) > 0) {
                    foreach ($result as $row) {
                        ?>
                        <tr onclick="window.location='attivita.php?stud=<?php echo $row['id']; ?>';">
                            <td><?php echo $row['cognome']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                        </tr>
                <?php
                }
                     }else{
                        echo "<tr>
                                <td colspan='3'>No stud</td>
                            </tr>";
                     }
                ?>
                    
            </tbody>
        </table>
    </div>
</body>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
</head>
<body>
<?php
    session_start();
    $mail=$_REQUEST["mail"];
    $pass=$_REQUEST["password"];
    $db=new mysqli("localhost","root","","pcto");
    if ($db->connect_error)
        die("Connection failed: " . $db->connect_error);
    $qry="select * from prof where utente='$mail'";
    $result = $db->query($qry);

    if ($result->num_rows>0) {
        $row = $result->fetch_assoc();
        if($row["psw"]==$pass){
            $_SESSION["log"]=TRUE;
            $_SESSION["errLog"]=FALSE;
            $_SESSION["global"]= $row["global"];
            $_SESSION["stud"]= false;
            $_SESSION["id"]= $row["id"];
            header( "refresh:0; url=classi.php" );
        }
        else{
            $_SESSION["errLog"]=TRUE;
            header( "refresh:0; url=index.php" ); 
        }
    } elseif($db->query("select * from studenti where utente='$mail'")->num_rows>0) {
        $result=$db->query("select * from studenti where utente='$mail'");
        $row = $result->fetch_assoc();
        if($row["psw"]==$pass){
            $_SESSION["log"]=TRUE;
            $_SESSION["errLog"]=FALSE;
            $_SESSION["stud"]= TRUE;
            $_SESSION["id"]= $row["id"];
            header("refresh:0; url=attivita.php?stud=".$row["id"]);
        }
        else{
            $_SESSION["errLog"]=TRUE;
            header( "refresh:0; url=index.php" ); 
        }

    } else {
        $_SESSION["errLog"]=TRUE;
        header( "refresh:0; url=index.php" ); 
    }
    $db->close();
?>
</body>
</html>
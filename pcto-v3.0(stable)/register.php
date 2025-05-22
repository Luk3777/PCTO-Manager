<?php session_start(); 
if ($_SESSION["log"] == FALSE|| $_SESSION["stud"] == TRUE) {
    header("refresh:0; url=index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
      <a href="classi.php" class="btn btn-secondary ms-2"><--</a>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="mb-4 text-center">Registrazione utenti</h3>
                        <form action="reg.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" required name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="sur" class="form-label">Cognome</label>
                                <input type="text" class="form-control" required name="sur" id="sur">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tipo account:</label>
                              <div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" required name="act" id="stud" value="S">
                                <label class="form-check-label" for="stud">Studente</label>
                              </div>
                              <div id="classField" class="mt-3" style="display:none;">
                                <label for="class" class="form-label">Classe</label>
                                <select class="form-select" name="class" id="class" required>
                                  <option value="" disabled selected>Seleziona una classe</option>
                                  <?php
                                  $conn = new mysqli("localhost", "root", "", "pcto");
                                  if ($conn->connect_error) {
                                    echo "<option disabled>Errore connessione DB</option>";
                                  } else {
                                    $result = $conn->query("SELECT * FROM classi ORDER BY anno DESC");
                                    if ($result && $result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                        echo "<option value='$row[id]'>$row[nome] $row[indirizzo] $row[anno]</option>";
                                      }
                                    } else {
                                      echo "<option disabled>Nessuna classe trovata</option>";
                                    }
                                    $conn->close();
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" required name="act" id="prof" value="P">
                                <label class="form-check-label" for="prof">Professore</label>
                              </div>
                              <div id="subjectField" class="mt-3" style="display:none;">
                                <label for="subject" class="form-label">Materia</label>
                                <input type="text" class="form-control" name="subject" id="subject">
                              </div>
                              <script>
                                function toggleFields() {
                                var isStud = document.getElementById('stud').checked;
                                var isProf = document.getElementById('prof').checked;
                                var classField = document.getElementById('classField');
                                var subjectField = document.getElementById('subjectField');
                                var classSelect = document.getElementById('class');
                                var subjectInput = document.getElementById('subject');
                                
                                classField.style.display = isStud ? 'block' : 'none';
                                subjectField.style.display = isProf ? 'block' : 'none';

                                if (isStud) {
                                  classSelect.setAttribute('required', 'required');
                                } else {
                                  classSelect.removeAttribute('required');
                                }
                                if (isProf) {
                                  subjectInput.setAttribute('required', 'required');
                                } else {
                                  subjectInput.removeAttribute('required');
                                }
                                }
                                document.getElementById('stud').addEventListener('change', toggleFields);
                                document.getElementById('prof').addEventListener('change', toggleFields);
                                window.addEventListener('DOMContentLoaded', toggleFields);
                              </script>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Registra</button>
                        </form>
                        <?php
                        if (isset($_SESSION["error"])){
                            echo "<div class='alert alert-danger mt-3'>$_SESSION[error]</div>";
                            unset($_SESSION["error"]);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
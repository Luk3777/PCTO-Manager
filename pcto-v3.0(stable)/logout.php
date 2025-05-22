<?php
    session_start();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpg" href="/img/logo.jpeg">
    <style>
        .logout-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
        }
        .logout-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 48px 32px;
            text-align: center;
        }
        .logout-title {
            font-size: 3rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .logout-text {
            font-size: 1.3rem;
            margin-bottom: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-card">
            <img src="/img/logo.jpeg" alt="Logo" style="width:80px; border-radius:50%; margin-bottom:20px;">
            <div class="logout-title">Logout effettuato</div>
            <div class="logout-text">Arrivederci!</div>
            <p class="mt-4"><a href="index.php" class="btn btn-outline-primary">Torna al login</a></p>
        </div>
    </div>
</body>
</html>
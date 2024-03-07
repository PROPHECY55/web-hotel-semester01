<head>
    <link rel="stylesheet" href="../css/error404.css">
</head>

<div class="error">
    <img src="../src/img/error_403.png" alt="Error Image">
    <div class="container">
        <h1>403. Forbidden</h1>
        <p>You don't have permission to visit <code><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></code> contact an admin if you think this is a mistake.</p>
        <a href="?page=home">Go to the Home Page ↵</a>
    </div>
</div>
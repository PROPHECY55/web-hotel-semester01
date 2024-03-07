<head>
    <link rel="stylesheet" href="../css/error404.css">
</head>

<div class="error">
    <img src="../src/img/error_404.png" alt="Error Image">
    <div class="container">
        <h1>404. That’s an error.</h1>
        <p>The requested URL <code><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></code> was not found on this server.</p>
        <a href="?page=home">Go to the Home Page ↵</a>
    </div>
</div>